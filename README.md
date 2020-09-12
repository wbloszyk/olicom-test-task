# Olicom - zadanie rekrutacyjne

### Instalacja

W celu uruchomienia aplikacji należy skopiować `.env` do `.env.local` i skonfigurować następujące zmienne środowiskowe:

- GITHUB_AUTH_METHOD
- GITHUB_USERNAME
- GITHUB_SECRET

### Testy

W celu uruchomienia aplikacji należy skopiować `.env` do `.env.local` i skonfigurować następujące zmienne środowiskowe:

- GITHUB_AUTH_METHOD
- GITHUB_USERNAME
- GITHUB_SECRET

I uruchomić skrypt:

    vendor/bin/simple-phpunit
    
Tutaj również należy pamiętać o poprawnie skonfigurowanych zmiennych środowiskowych.   

### Komendy

    api:github:getUser [login]
    api:github:getRepository [login] [repository]
    
### Rzeczy pominięte lub uproszczone

- nie przekonwertowałem danych z Githuba API na format danych z zadania 
- ubogie testy i brak testu wydajnościowego (poza ograniczeniem wykonania do 1 sek)
- wsparcie API tylko dla json
- słabe zaprezentowanie danych w komendach
- brak obsługi pobieranie nieistniejących użytkowników i repozytoriów

### Moja prace nad REST API
- https://github.com/sonata-project/dev-kit/issues/778
