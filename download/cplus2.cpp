#include <iostream>
#include <string>
#include <cstdlib> 
#include <fstream> 

using namespace std; 

class Msg
{
public:
    int GetX(){return 0;}
};

class Y
{
public:
    void PrepareForMessage(){}
    void HandleYMsg(Msg *p){}
};

class X
{
    int m_x;
public:

    void HandleMsg(Y *pY, Msg *pMsg)
    {
        pY->PrepareForMessage();
        pY->HandleYMsg(pMsg);
        cout<<"Hello World!\n";
        m_x = pMsg->GetX();     // Crash takes place here
    }
};

int main(int argc, char* argv[])
{
    X *pX = NULL;
    Y y;
    Msg * pMsg=NULL;
    char name[50];

    int age;
    ofstream outfile;
    //opening file in same directory as project
    outfile.open("File_I_Made.dat");

    cout << "Enter your name" << endl;

    cin >> name;

    outfile << name << endl;

    cout << "Enter your age" << endl;

    cin >> age;

    outfile << age << endl;

    outfile.close();

    ifstream ifs ( "File_I_Made.dat" , ifstream::in );

    cout<<endl<<"your input "<<endl;
    while (ifs.good()){
        cout<<endl;
        ifs.getline(name,50);
        cout<<name;
    }

    cout<<endl<<endl;

    ifs.close();

    // pX is still NULL
    //pX->HandleMsg(&y, pMsg);

    return 0;
}
