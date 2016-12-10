# Jáchym Toušek - Sculpin Blog

[![Build Status](https://img.shields.io/travis/enumag/enumag.cz.svg?style=flat-square)](https://travis-ci.org/enumag/enumag.cz)

## How to run it?

```sh
composer update
php vendor/symplify/php7_sculpin/bin/sculpin generate --watch --server
```

And open `http://localhost:8000`.

## For production?

```sh
vendor/bin/sculpin generate --env=prod
```
