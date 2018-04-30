# A php project for the 2nd semester webdev course

## Install and run:
`composer install`

`php -S localhost:port`

## Check out the [heroku app](https://damp-journey-53796.herokuapp.com/)

## Try out some routes:
`/` (prints current date)

`/hello/yourname`

`/author`

`/info`

`/print`

`/rates`

`/add/a/b`, `/sub/a/b`, `/mpy/a/b`, `/div/a/b`, `/pow/a/b` where a, b - any numbers (or send a request with 'Content-type:  application/json' to get the result as a JSON object)

invert a byte: `echo -e '0xa7' | curl -X POST --data-binary @- localhost:8080/byte`






