Użytkownik powinien mieć zainstalowanego xampp, laravel, composer,vscode(lub inne IDE)



Należy pobrać obie części aplikacji.
Laravel -> https://github.com/Timhello1/tasklist.git
angular -> https://github.com/Timhello1/TaskFrontEnd.git
Następnie aby uruchomić program należy wykorzystać IDE.
W przypadku laravela dla przykładu wykorzystuję vscode
Po pobrniu należy otworzyć folder z projektem.
1. Należy zmienić nazwę pliku .env.example na .env
2. uruchomić xampp i rozpocząć serwis apache i mysql
3. W pliku .env należy uzupełnić swoje dane. Mianowicie należy sprawdzić w xampp w wierszu mysql i kolumnie port właśnie port i wpisać go w pliku w miejscu DB_PORT=   .
4. Następnie należy kliknąć przycisk ADMIN w xamppie w wierszu mysql. W tym miejscu należy spojrzeć na prawą stronę ekranu na okienko Database serwer (gdyby otworzona została inna zakładka proszę kliknąć logo phpMyAdmin). Proszę znaleźć wiersz który wygląda podobnie "Serwer: 127.0.0.1 via TCP/IP" i adres który u mnie to 127.0.0.1 wpisać w pliku .env w miejscu DB_HOST=
5. Następnie prosze przejsc do zakładki Databases w phpMyAdmin i w miejsce database name wpisać tasklistapp  a następnie kliknąć guzik create
6. Po zrobieniu tego możemy wrócić do IDE.
7. Należy otworzyć terminal i za jego pomocą przejść do folderu aplikacji używając komendy "cd tasklist"
8. Użyj komendy "composer install"
9. Następnie należy użyć komendy "php artisan jwt:secret"
10. Następnie proszę użyć komendy "php artisan migrate" gdyby wyskoczyło zapytanie kliknąć "y"
11. Rozpocząć działanie programu za pomocą "php artisan serve"
12.Kliknąć link który pojawi się w konsoli
13.Kliknąć guzik generate app key i odświerz stronę
14.Część Backendowa w tym momencie działa
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
15. Proszę otworzyć projekt frontendu w IDE (dla przykładu używam Webstorm)
16. otworzyć terminal
17. wpisać komendę "npm install"
18. wpisać komendę "ng serve"
19. klknąć w wyświetlony link
