#include <cstdio>
#include <cstring>
#include <cstdlib>
#include <unistd.h>

int main() {
	while(1) {
		FILE *fp;
		fp = fopen("ip.txt", "r");
		char ip[200];
		memset(ip, 0, sizeof(ip));
		fscanf(fp, "%s", ip);
		fclose(fp);

        system("curl https://a.b.com/getip.php > ./ip.txt");

		fp = fopen("ip.txt", "r");
		char ipnew[200];
		memset(ipnew, 0, sizeof(ipnew));
		fscanf(fp, "%s", ipnew);
		fclose(fp);

		if (strcmp(ip, ipnew) == 0) {
			printf("IP not change.\n");
		} else {
			printf("Updating from %s to %s...\n", ip, ipnew);
			char cmd[400];
			memset(cmd, 0, sizeof(cmd));
			sprintf(cmd, "curl https://a.b.com/a.b.com-cfapi-change.php?ip=%s > last.html", ipnew);
			system(cmd);
			printf("Update command done.\n");
		}

		printf("\n=================================\n");
		sleep(300);
	}
	return 0;
}
