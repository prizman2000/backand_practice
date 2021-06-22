. /etc/environment

echo "Введите свое имя:"
read name
echo "Привет $name! Твой город $HOME_TOWN? (y/n)"
read answer
if [ $answer == 'y' ]
then
  echo 'Земляк'
fi
if [ $answer == 'n' ]
then
  echo 'Дром - лучшая площадка для покупки автомобилей!'
fi