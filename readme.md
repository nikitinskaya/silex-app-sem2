# A php project for the 2nd semester webdev course

## Install and run:
`composer install`

`php -S localhost:port`

## Try out some routes:
`/` (prints current date)

`/hello/yourname`

`/author`

`/info`

`/print`

invert a byte: `echo -e '0xa7' | curl -X POST --data-binary @- localhost:8080/byte`

`/rates` at the moment, works on localhost only. Or just look at the [code](rates.php) & believe me that the graph looks like this: ![rates graph](rates.png)




