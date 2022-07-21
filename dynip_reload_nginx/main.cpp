#include <cstdio>
#include <cstdlib>
#include <cstring>
#include <ctime>
#include <unistd.h>

int main() {
	int bufSize = 100;
	int hc = 2;
	char **host = new char*[hc];
	char **ip = new char*[hc];
	for (int i = 0; i < hc; i++) {
		host[i] = new char[bufSize];
		ip[i] = new char[bufSize];
	}
	strcpy(host[0], "a1.b.com");
	strcpy(host[1], "a1.c.com");
	strcpy(ip[0], "");
	strcpy(ip[1], "");

	char cmd[200];
	char buf0[100], buf1[100], buf2[100], buf3[100];
	bool needReload;
	FILE *fin;
	while (1) {
		needReload = false;
		for (int i = 0; i < hc; i++) {
			memset(cmd, 0, sizeof(cmd));
			strcat(cmd, "host ");
			strcat(cmd, host[i]);
			strcat(cmd, " > iptemp.txt");
			fin = fopen("iptemp.txt", "r");
			fscanf(fin, "%s%s%s%s", buf0, buf1, buf2, buf3);
			fclose(fin);
			printf("host[%i] old ip = %s, new ip = %s\n", i, ip[i], buf3);
			if (strcmp(ip[i], buf3) != 0)
				needReload = true;
			strcpy(ip[i], buf3);
			system(cmd);
		}
		if (needReload) {
			printf("reloading nginx...");
			system("systemctl reload nginx");
			printf("done\n");
		} else {
			printf("no need to reload\n");
		}
		printf("sleep for 60s\n");
		sleep(60);
	}
	return 0;
}
