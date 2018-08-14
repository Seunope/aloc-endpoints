<p align="center"><img src="https://aloc.ng/asset/images/slide/aloc-shield.png"></p>

<p align="center"><i>Get Inspired to Practice</i></p>

## About ALOC

ALOC is an adventure based CBT practice platform with an engaging game story that unravels as students’ progresses in game levels. We use gaming concepts to increase student practice time and grade. Hey! Still wondering what we do? We make learning fun, reward witty performance and academic excellence is the "new cool." -us!!! [https://aloc.ng]

- Experience CBT in game environment
- Gain free access to unlimited past questions
- Chat with students across Nigeria
- Get paid for being smart
- Learn for fun, play for glory
  
Finally, boring time are over, academic practice can now be Fun for students seeking university admission.

## About ALOC Questions API

This app gives users and developers access to our questions via APIs. Free access to over 7,000 past questions for JAMB WAEC NECO POST-UTME

Make api calls to have access to over 7,000 Major Nigeria past questions. 100% FREE

Focus on building great apps for students with unlimited access to api calls for trivial questions of major exams in Nigeria

## Setup

- `php artisan composer update`

- In the project root directory create another copy of .env.example and rename it to .env

- Generate application key `php artisan key:generate`

- In .env file, supply values to DB_DATABASE, DB_USERNAME, DB_PASSWORD

- `php artisan migrate`

- You can load some dummy data into database for testing `php artisan db:seed --class=LoadDummyQuestions`

- `php artisan server` to load app. You Got it!

## API call Examples

Get a question

https://questions.aloc.ng/api/q?subject=chemistry

Get several questions

https://questions.aloc.ng/api/q/7?subject=chemistry

Get a question by year

https://questions.aloc.ng/api/q?subject=chemistry&year=2005

Get a question by exam type

https://questions.aloc.ng/api/q?subject=chemistry&type=utme

Get a question by type and year

https://questions.aloc.ng/api/q?subject=chemistry&year=2009&type=utme

For more detailed example visit https://questions.aloc.ng
## ALOC Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going ALOC development. If you are interested in becoming a sponsor, please visit send a mail to Admin [info@aloc.ng]:

- **[Magbodo](https://magbodo.com/)**

## Contributing

Thank you for considering contributing to the ALOC Questions Api end point!

## Security Vulnerabilities

If you discover a security vulnerability within ALOC APIs, please send an e-mail to Admin via [info@aloc.ng](mailto:info@aloc.ng. All security vulnerabilities will be promptly addressed.

## License

The ALOC API end point is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
