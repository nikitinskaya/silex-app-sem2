# A php project for the 2nd semester webdev course

## Install and run:
`composer install`

`php -S localhost:port`

## Check out the [heroku app](https://damp-journey-53796.herokuapp.com/)

## Try out some routes:
[/](https://damp-journey-53796.herokuapp.com/) (prints current date)

[/hello/yourname](https://damp-journey-53796.herokuapp.com/hello/Elias)

[/author](https://damp-journey-53796.herokuapp.com/author)

[/info](https://damp-journey-53796.herokuapp.com/info)

[/print](https://damp-journey-53796.herokuapp.com/print)

[/rates](https://damp-journey-53796.herokuapp.com/rates)

[/add/a/b](https://damp-journey-53796.herokuapp.com/add/2/3), [/sub/a/b](https://damp-journey-53796.herokuapp.com/sub/4/2), [/mpy/a/b](https://damp-journey-53796.herokuapp.com/mpy/6/4), [/div/a/b](https://damp-journey-53796.herokuapp.com/div/80/8), [/pow/a/b](https://damp-journey-53796.herokuapp.com/pow/5/2) where a, b - any numbers (or send a request with 'Content-type:  application/json' to get the result as a JSON object)

invert a byte: `echo -e '\xa7' | curl -X POST --data-binary @- https://damp-journey-53796.herokuapp.com/byte`






