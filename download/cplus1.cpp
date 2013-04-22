#include <iostream>
#include <string>
#include <cstdlib> 

using namespace std;

class color
{
  
};

class animal{
public:
  int eyes;
  bool has_mouth;
  int legs;
  int hands;
  
public:
  void move(){}
  void make_sound(){}
};

class human : public animal
{
public:
  int height;
  color eye_color;
  
public:
  void speak(string s)
  {
    cout <<s;
  }
};

class manly_feature
{
public:
  bool mustuche;
};

class man: public human,public manly_feature
{
  int wealth;
public:
  
  man()
  {
    wealth=0;
  }
  
public:
  void make_money()
  {
    wealth++;
    cout <<"wealth now is " << wealth <<" million dollars."<<endl;
  }
};

class female_feature
{
public:
  bool has_breast;
};

class woman: public human,public female_feature
{
public:
  void born_baby()
  {
    int r=rand();
    string f=r%2?"boy":"girl";
    cout << "It's a " << f <<endl<<endl;
  }
};

int main()
{
  man person;
  woman p1;
  int count=0;
  while (true)
  {
    sleep(1);
    person.make_money();
    count++;
    if (count % 10) p1.born_baby(); 
  }
  
}
