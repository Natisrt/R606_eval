# R606_eval

## gitflow
### name branch : 
- master = prod
- develop = dev
- feat/...  = feature develop on this branch

### name commit : 
- feat: ... = new feature add
- fix = fix error in code

## Start project
```
docker compose up --build -d
```
## Start migration
```
php migrate.php
```

## Executer tests
```
composer install

./vendor/bin/phpunit tests/MainTests.php
```