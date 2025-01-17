
## Wymagania wstępne

1. Zainstalowany [Docker](https://www.docker.com/) i [Docker Compose](https://docs.docker.com/compose/).
2. Zainstalowany [Git](https://git-scm.com/).

## Instalacja i uruchomienie projektu na Dockerze

### 1. Sklonowanie repozytorium

```bash
# Sklonuj repozytorium
$ git clone https://github.com/mikoajp/AWS-Athena.git albo git@github.com:mikoajp/AWS-Athena.git

# Przejdź do katalogu projektu
$ cd AWS-Athena
```


### 2. Uruchomienie kontenerów

Uruchom kontenery za pomocą Docker Compose:

```
$ docker-compose build
$ docker-compose up

```
### 3. Konfiguracja

W katalogu projektu uruchom komendy:
```
$ npm run install
$ npm run build
$ npm run dev
```
### 4. Sprawdzenie działania aplikacji

Po uruchomieniu kontenerów aplikacja powinna być dostępna pod adresem:

```
http://0.0.0.0:8000
```

```

### 6. Zatrzymanie kontenerów

Aby zatrzymać kontenery, użyj polecenia:

```
$ docker-compose down
```

