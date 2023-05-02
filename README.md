# packt-accessment

Bookstore is a professional open source bookstore site built using Laravel (Laravel Modular using nvidart laravel package), Vue, Vuex, Vue-router and Bootstrap. It offers a minimalist interface. Get Some of the features book store site including book search using laravel scout, pagination using laravel-vue-pagination and admin can create, update and delete books.

Features:

- Laravel-Vue-Pagination.
- Elastic Searching using laravel scout.
- Admin store,update and delete books.
- Designed using bootstrap Template.
- Exception Handling for resource and invalid path in api.

To use Bookstore first you have to clone project on local after that follow below points

Preinstalled Application:

- php > 8.0.2
- composer
- node (v16.18.0)
- git

Backend Setup:

- cd backend
- cp .env.example .env
- composer install
- php artisan key:generate
- php artisan storage:link
- Provide db name, username and password in .env
- Add " SCOUT_DRIVER=database " in your .env file (For Elastic search)
- php artisan module:migrate Book
- php artisan module:seed Book
- php artisan serve

Frontend Setup:

- cd frontend
- npm install
- npm run serve

Api Endpoints(method,endpoint)

headers: {
"Content-Type": "application/json",
"Accept": "application/json",
}

List Books():

- GET
- http://127.0.0.1:8000/api/v1/books

Search Book(using any attributes containing title,author,published data,isbn,genre):

- GET
- http://127.0.0.1:8000/api/v1/books?search=this

Get single book:

- GET
- http://127.0.0.1:8000/api/v1/books/134

Delete book:

- DELETE
- http://127.0.0.1:8000/api/v1/books/134

Store book(Pass data in body):

- POST
- http://127.0.0.1:8000/api/v1/books
  - body parameters:
    title,
    description,
    author,
    genre,
    isbn,
    image,
    published(0 or 1) if 1 then publisher field is required. (if 1 then in backend it will store current datetimestamp in database)
    publisher.(not required if pubished value is 0)

Update book(Pass data in body):

- POST
- http://127.0.0.1:8000/api/v1/books/133
  - body parameters:
    title,
    description,
    author,
    genre,
    isbn,
    image,
    published(0 or 1) if 1 then publisher field is required. (if 1 then in backend it will store current datetimestamp in database)
    publisher.(not required if pubished value is 0)

Dashboard View:

https://prnt.sc/L_kQgv8ITMiq

Pagination On Dashboard:

https://prnt.sc/P_W3LLGjCTVB

Admin Book Grid Page:

https://prnt.sc/vdpvWDk7mbmV

Admin Add Book Page:

https://prnt.sc/LmQEQ4arPSWu

Admin Update Book Page:

https://prnt.sc/0fYOK_u_Id2J

Note:
-> image will not be visible if you used seeder to generate dummy books. because there is some limit to generate fake image.
