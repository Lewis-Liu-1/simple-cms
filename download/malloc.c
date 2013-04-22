#include <stdio.h>
#include <stdlib.h>
#include <string.h>

struct person
{
	char firstname[10];
	char familyname[10];
};

int showme(int val)
{
	int i=0;
	int ret=0;
	for(i=0;i<val;i++)
	{
		ret+=i;
	}
	return ret;
}

int main()
{
	char *p;
	int ret;
	struct person aman;
	struct person *awoman;

	p=malloc(sizeof("I love you"));
	strcpy(p,"I love you");
	printf("%s\n",p);

	printf("Input a number:");
	scanf("%d",&ret);
	ret=showme(ret);

	printf("Value=%d\n",ret);

	free(p);

	printf("Gentleman Name:");
	scanf("%s",aman.firstname);
	printf("Gentleman your Family Name:");
	scanf("%s",aman.familyname);

	printf("Welcome %s board\n\n",aman.familyname);

	awoman=malloc(sizeof awoman);
	printf("Lady your Name:");
	scanf("%s",awoman->firstname);
	printf("Lady your Family Name:");
	scanf("%s",awoman->familyname);

	printf("Hello lady: %s \n",awoman->familyname);

	free(awoman);
	exit(0);
}
