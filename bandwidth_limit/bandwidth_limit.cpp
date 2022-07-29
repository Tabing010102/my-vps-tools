#include <cstdio>
#include <cstring>
#include <ctime>
#include <unistd.h>
#include <cstdlib>

// config
char CONFIG_FILE[] = "config";  // config file name
int DEBUG = 0;
int LIMIT_DEVICE_NUM = -1;      // limit network interface count
char** LIMIT_DEVICES;         // limit network interfaces
int RESET_DAY = -1;             // bandwidth reset day
// bandwidth limit mode
// ul: upload only
// uldl: upload + download
// maxuldl: max(upload, download)
char LIMIT_MODE[10] = "";       // bandwidth limit mode
long long UL_LIMIT = -1;        // upload limit
long long DL_LIMIT = -1;        // download limit
long long ULDL_LIMIT = -1;      // upload and download limit
char LIMIT_SPEED[20] = "";      // tc traffic limit speed
int CHECK_INTERVAL = -1;        // check interval in seconds

// global var
long long LAST_UL = -1;
long long LAST_DL = -1;
long long LAST_ULDL = -1;
int LAST_DAY = -1;              // day of month
// int CUR_DAY = -1;

// stats
char STATS_FILE[] = "stats";    // stats file name
long long CUR_UL = -1;
long long CUR_DL = -1;
long long CUR_ULDL = -1;
// 0 false 1 true
int BANDWIDTH_CLEARED = -1;
int SPEED_LIMIT_IN_EFFECT = -1;

char LogBuf[200];

void LogPrint(const char *level, const char *message, const char *module = NULL) {
    if (module == NULL || strlen(module) == 0) {
        fprintf(stdout, "[%s] %s\n", level, message);
    } else {
        fprintf(stdout, "[%s/%s] %s\n", level, module, message);
    }
}

void LogInfo(const char *message, const char *module = NULL) {
    LogPrint("Info", message, module);
}

void LogDebug(const char *message, const char *module = NULL) {
    if (!DEBUG) return;
    LogPrint("Debug", message, module);
}

void LogDebugVar(const char *var, const char *value, const char *module = NULL) {
    sprintf(LogBuf, "%s = %s", var, value);
    LogDebug(LogBuf, module);
}

void LogDebugVar(const char *var, const int value, const char *module = NULL) {
    sprintf(LogBuf, "%s = %d", var, value);
    LogDebug(LogBuf, module);
}

void LogDebugVar(const char *var, const long long value, const char *module = NULL) {
    sprintf(LogBuf, "%s = %lld", var, value);
    LogDebug(LogBuf, module);
}

void LogDebugVar(const char *var, const double value, const char *module = NULL) {
    sprintf(LogBuf, "%s = %.3lf", var, value);
    LogDebug(LogBuf, module);
}

void LogErrorAndExit(const char *message, const char *module = NULL) {
    LogPrint("Error", message, module);
    exit(0);
}

// read config file
void ReadConfig() {
    FILE *fin = fopen(CONFIG_FILE, "r");
    fscanf(fin, "%d", &DEBUG);
    fscanf(fin, "%d", &LIMIT_DEVICE_NUM);
    LIMIT_DEVICES = (char **)malloc(LIMIT_DEVICE_NUM * sizeof(char *));
    char buf[20];
    for (int i = 0; i < LIMIT_DEVICE_NUM; i++) {
        fscanf(fin, "%s", buf);
        LIMIT_DEVICES[i] = (char *)malloc((strlen(buf) + 1) * sizeof(char));
        memcpy(LIMIT_DEVICES[i], buf, sizeof(buf));
    }
    fscanf(fin, "%d", &RESET_DAY);
    fscanf(fin, "%s", LIMIT_MODE);
    fscanf(fin, "%lld", &UL_LIMIT);
    fscanf(fin, "%lld", &DL_LIMIT);
    fscanf(fin, "%lld", &ULDL_LIMIT);
    fscanf(fin, "%s", LIMIT_SPEED);
    fscanf(fin, "%d", &CHECK_INTERVAL);
    fclose(fin);


    LogDebugVar("DEBUG", DEBUG, "ReadConfig");
    LogDebugVar("LIMIT_DEVICE_NUM", LIMIT_DEVICE_NUM, "ReadConfig");
    char varName[20];
    // <= 9
    for (int i = 0; i < LIMIT_DEVICE_NUM; i++) {
        memset(varName, 0, sizeof(varName));
        strcat(varName, "LIMIT_DEVICE[");
        char buf[2];
        buf[0] = i + '0'; buf[1] = '\0';
        strcat(varName, buf);
        strcat(varName, "]");
        LogDebugVar(varName, LIMIT_DEVICES[i], "ReadConfig");
    }
    LogDebugVar("RESET_DAY", RESET_DAY, "ReadConfig");
    LogDebugVar("LIMIT_MODE", LIMIT_MODE, "ReadConfig");
    LogDebugVar("UL_LIMIT", UL_LIMIT, "ReadConfig");
    LogDebugVar("DL_LIMIT", DL_LIMIT, "ReadConfig");
    LogDebugVar("ULDL_LIMIT", ULDL_LIMIT, "ReadConfig");
    LogDebugVar("LIMIT_SPEED", LIMIT_SPEED, "ReadConfig");
    LogDebugVar("CHECK_INTERVAL", CHECK_INTERVAL, "ReadConfig");
}

// read stats
void ReadStats() {
    FILE *fin = fopen(STATS_FILE, "r");
    fscanf(fin, "%lld", &CUR_UL);
    fscanf(fin, "%lld", &CUR_DL);
    fscanf(fin, "%lld", &CUR_ULDL);
    fscanf(fin, "%d", &BANDWIDTH_CLEARED);
    fscanf(fin, "%d", &SPEED_LIMIT_IN_EFFECT);
    fclose(fin);


    LogDebugVar("CUR_UL", CUR_UL, "ReadStats");
    LogDebugVar("CUR_DL", CUR_DL, "ReadStats");
    LogDebugVar("CUR_ULDL", CUR_ULDL, "ReadStats");
    LogDebugVar("BANDWIDTH_CLEARED", BANDWIDTH_CLEARED, "ReadStats");
    LogDebugVar("SPEED_LIMIT_IN_EFFECT", SPEED_LIMIT_IN_EFFECT, "ReadStats");
}

long long GetRxBytes() {
    FILE *fin;
    char fileNameBuf[50];
    long long DL, TDL = 0;
    for (int i = 0; i < LIMIT_DEVICE_NUM; i++) {
        strcpy(fileNameBuf, "/sys/class/net/");
        strcat(fileNameBuf, LIMIT_DEVICES[i]);
        strcat(fileNameBuf, "/statistics/rx_bytes");
        fin = fopen(fileNameBuf, "r");
        fscanf(fin, "%lld", &DL);
        TDL += DL;
        fclose(fin);
    }
    return TDL;
}

long long GetTxBytes() {
    FILE *fin;
    char fileNameBuf[50];
    long long UL, TUL = 0;
    for (int i = 0; i < LIMIT_DEVICE_NUM; i++) {
        strcpy(fileNameBuf, "/sys/class/net/");
        strcat(fileNameBuf, LIMIT_DEVICES[i]);
        strcat(fileNameBuf, "/statistics/tx_bytes");
        fin = fopen(fileNameBuf, "r");
        fscanf(fin, "%lld", &UL);
        TUL += UL;
        fclose(fin);
    }
    return TUL;
}

// get day of Month
int GetDay() {
    time_t rawTime;
    time(&rawTime);
    struct tm * timeInfo = localtime(&rawTime);
    return timeInfo->tm_mday;
}

// init global var
void InitGVar() {
    LAST_UL = GetTxBytes();
    LAST_DL = GetRxBytes();
    LAST_ULDL = LAST_UL + LAST_DL;
    LAST_DAY = GetDay();

    LogDebugVar("LAST_UL", LAST_UL, "InitGVar");
    LogDebugVar("LAST_DL", LAST_DL, "InitGVar");
    LogDebugVar("LAST_ULDL", LAST_ULDL, "InitGVar");
    LogDebugVar("LAST_DAY", LAST_DAY, "InitGVar");
}

// get max day of Month
int GetMaxDay() {
    time_t rawTime;
    time(&rawTime);
    struct tm * timeInfo = localtime(&rawTime);
    int m = timeInfo->tm_mon + 1;
    if (m==1 || m==3 || m==5 || m==7 || m==8 || m==10 || m==12) {
        return 31;
    } else if(m==4 || m==6 || m==9 || m==11) {
        return 30;
    } else {
        return 28;
    }
}

void ResetBandwidth() {
    CUR_UL = 0;
    CUR_DL = 0;
    CUR_ULDL = 0;
    BANDWIDTH_CLEARED = 1;
}

void ExecSetSpeedLimit() {
    char cmd[100];
    for (int i = 0; i < LIMIT_DEVICE_NUM; i++) {
        cmd[0] = '\0';
        strcat(cmd, "./speed_limit.sh ");
        strcat(cmd, LIMIT_DEVICES[i]);
        strcat(cmd, " ");
        strcat(cmd, LIMIT_SPEED);
        LogDebugVar("cmd", cmd, "ExecSetSpeedLimit");
        system(cmd);
    }
    SPEED_LIMIT_IN_EFFECT = 1;
}

void ExecUnsetSpeedLimit() {
    char cmd[100];
    for (int i = 0; i < LIMIT_DEVICE_NUM; i++) {
        cmd[0] = '\0';
        strcat(cmd, "./unset_speed_limit.sh ");
        strcat(cmd, LIMIT_DEVICES[i]);
        strcat(cmd, " ");
        strcat(cmd, LIMIT_SPEED);
        LogDebugVar("cmd", cmd, "ExecUnsetSpeedLimit");
        system(cmd);
    }
    SPEED_LIMIT_IN_EFFECT = 0;
}

void WriteStatsFile() {
    FILE *fout;
    fout = fopen(STATS_FILE, "w");
    char buf[100];
    memset(buf, 0, sizeof(buf));
    if (strcmp(LIMIT_MODE, "ul") == 0) {
        sprintf(buf, "%lld\n-1\n-1\n%d\n%d", CUR_UL, BANDWIDTH_CLEARED, SPEED_LIMIT_IN_EFFECT);
    } else if (strcmp(LIMIT_MODE, "uldl") == 0) {
        sprintf(buf, "-1\n-1\n%lld\n%d\n%d", CUR_ULDL, BANDWIDTH_CLEARED, SPEED_LIMIT_IN_EFFECT);
    } else if (strcmp(LIMIT_MODE, "maxuldl") == 0) {
        sprintf(buf, "%lld\n%lld\n-1\n%d\n%d", CUR_UL, CUR_DL, BANDWIDTH_CLEARED, SPEED_LIMIT_IN_EFFECT);
    } else {
        LogErrorAndExit("unknown limit mode", "WriteStatsFile");
    }
    LogDebugVar("buf", buf, "WriteStatsFile");
    LogInfo("writing stats file...", "WriteStatsFile");
    fprintf(fout, "%s", buf);
    fclose(fout);
}

void CheckDay() {
    if (BANDWIDTH_CLEARED == 1) {
        LogInfo("setting BANDWIDTH_CLEARED to 0", "CheckDay");
        BANDWIDTH_CLEARED = 0;
        if (SPEED_LIMIT_IN_EFFECT == 1) {
            LogInfo("speed limit in effect, unsetting speed limit", "CheckDay");
            ExecUnsetSpeedLimit();
        }
    } else {
        // need to reset
        if ( (LAST_DAY == GetMaxDay() && LAST_DAY < RESET_DAY) || 
             (LAST_DAY == RESET_DAY) ) {
                LogInfo("day changed, now reset day, reseting bandwidth", "CheckDay");
                ResetBandwidth();
                if (SPEED_LIMIT_IN_EFFECT == 1) {
                    LogInfo("speed limit in effect, unsetting speed limit", "CheckDay");
                    ExecUnsetSpeedLimit();
                }
             }
    }
    LogInfo("writing stats file...", "CheckDay");
    WriteStatsFile();
}

bool UpdateDay() {
    int day = GetDay();
    LogDebugVar("LAST_DAY", LAST_DAY, "UpdateDay");
    LogDebugVar("day", day, "UpdateDay");
    if (day == LAST_DAY) {
        return false;
    } else {
        LAST_DAY = day;
        return true;
    }
}

bool CheckBandwidth() {
    if (strcmp(LIMIT_MODE, "ul") == 0) {
        if (CUR_UL >= UL_LIMIT) return true;
    } else if (strcmp(LIMIT_MODE, "uldl") == 0) {
        if (CUR_ULDL >= ULDL_LIMIT) return true;
    } else if (strcmp(LIMIT_MODE, "maxuldl") == 0) {
        if (CUR_UL >= UL_LIMIT || CUR_DL >= DL_LIMIT) return true;
    } else {
        LogErrorAndExit("unknown limit mode", "CheckBandwidth");
    }
}

double GetGBytes(long long n) {
    return (double)n/1073741824.0;
}

void LogBandwidthLeft() {
    char buf[100];
    if (strcmp(LIMIT_MODE, "ul") == 0) {
        sprintf(buf, "(mode: ul) upload bandwidth left: %.3lf GiB", GetGBytes(UL_LIMIT - CUR_UL));
    } else if (strcmp(LIMIT_MODE, "uldl") == 0) {
        sprintf(buf, "(mode: uldl) total bandwidth left: %.3lf GiB", GetGBytes(ULDL_LIMIT - CUR_ULDL));
    } else if (strcmp(LIMIT_MODE, "maxuldl") == 0) {
        sprintf(buf, "(mode: maxuldl) upload bandwidth left: %.3lf GiB", GetGBytes(UL_LIMIT - CUR_UL));
        sprintf(buf, "(mode: maxuldl) download bandwidth left: %.3lf GiB", GetGBytes(DL_LIMIT - CUR_DL));
    } else {
        LogErrorAndExit("unknown limit mode", "LogBandwidthLeft");
    }
    LogInfo(buf, "LogBandwidthLeft");
}

void UpdateCur(const long long ulDiff, const long long dlDiff) {
    if (strcmp(LIMIT_MODE, "ul") == 0) {
        CUR_UL += ulDiff;
        LogDebugVar("CUR_UL", GetGBytes(CUR_UL), "UpdateCur");
    } else if (strcmp(LIMIT_MODE, "uldl") == 0) {
        CUR_ULDL += ulDiff + dlDiff;
        LogDebugVar("CUR_ULDL", GetGBytes(CUR_ULDL), "UpdateCur");
    } else if (strcmp(LIMIT_MODE, "maxuldl") == 0) {
        CUR_UL += ulDiff;
        CUR_DL += dlDiff;
        LogDebugVar("CUR_UL", GetGBytes(CUR_UL), "UpdateCur");
        LogDebugVar("CUR_DL", GetGBytes(CUR_DL), "UpdateCur");
    } else {
        LogErrorAndExit("unknown limit mode", "LogBandwidthLeft");
    }
}

void UpdateStats() {
    long long ul = GetTxBytes();
    long long dl = GetRxBytes();
    long long ulDiff = ul - LAST_UL;
    long long dlDiff = dl - LAST_DL;

    LogDebugVar("ul", GetGBytes(ul), "UpdateStats");
    LogDebugVar("dl", GetGBytes(dl), "UpdateStats");
    LogDebugVar("LAST_UL", GetGBytes(LAST_UL), "UpdateStats");
    LogDebugVar("LAST_UL", GetGBytes(LAST_UL), "UpdateStats");
    LogDebugVar("ulDiff", GetGBytes(ulDiff), "UpdateStats");
    LogDebugVar("dlDiff", GetGBytes(dlDiff), "UpdateStats");

    LAST_UL = ul;
    LAST_DL = dl;

    UpdateCur(ulDiff, dlDiff);

    char buf[100];
    sprintf(buf, "upload diff = %.3lf GiB", GetGBytes(ulDiff));
    LogInfo(buf, "UpdateStats");
    sprintf(buf, "download diff = %.3lf GiB", GetGBytes(dlDiff));
    LogInfo(buf, "UpdateStats");
    sprintf(buf, "total diff = %.3lf GiB", GetGBytes(ulDiff + dlDiff));
    LogInfo(buf, "UpdateStats");
    LogBandwidthLeft();

    if (SPEED_LIMIT_IN_EFFECT == 0 && CheckBandwidth()) {
        LogInfo("speed limit not in effect, setting speed limit", "UpdateStats");
        ExecSetSpeedLimit();
    }

    LogInfo("writing stats file...", "UpdateStats");
    WriteStatsFile();
}

int main() {
    ReadConfig();
    ReadStats();
    InitGVar();
    while (1) {
        if (UpdateDay()) {
            LogInfo("checking day...", "main");
            CheckDay();
        }
        LogInfo("updating stats...", "main");
        UpdateStats();
        LogInfo("sleep...", "main");
        usleep(CHECK_INTERVAL * 1000000);
    }
    return 0;
}