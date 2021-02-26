
<p align="center">
   <img src="/github/puzl.jpg" width="350px" height="auto">
</div>

#  Descrição do projeto
<h4> Projeto para gerencimaneto de carros e marcas. Totalmente modularizado e com a versão mais estável do VueJs e Laravel com banco de dados em MYSQL.</h4>

# :pushpin: Tabela de conteúdos

* [Tecnologias](#computer-technologies)
* [Ferramentas](#rocket-features)
* [Como executar](#construction_worker-how-to-run)
* [License](#closed_book-license)


### Web Screenshot

<p align="center">
   <img src="/github/list2.png" width="400px" height="300px">
     <img src="/github/create.png" width="400px" height="300px">
</h1>


# :computer: Technologies
This project was made using the follow technologies:

* [VueJS](https://vuejs.org/)      
* [Vuex](https://vuejs.org/)   
* [Laravel 8](https://laravel.com/)   
* [MYSQL](https://mysql.com/)   
* [Vue Router](https://vuejs.org/) 
* [Bootstrap](https://getbootstrap.com/)            

# :rocket: Features

  `BIBLIOTECAS` 
- Laravel Cors
- Bootstrap-Vue
- Axios
- Store
- Router
- Vue Mask

# Componentes desenvolvidos durante a criação do projeto

`COMPONENTES.VUE`
- Skeleton
- Pagination
- Modal
- Select2 com <a href="select2.org">select2.org</a>

### 📦 Run API


<p align="center">
   <img src="/github/laravel.png" width="350px" height="auto">
</div>

```bash
# Go to api folder
$ cd api

# Install Dependencies
$ composer install

# Generate migrations
php artisan migrate

# Generate seeders 
php artisan db:seed

# Run Aplication
$ php artisan serve or host nginx, apache
```
## API ROUTES

 get('/cars/')
 get('/cars/list')
 get('/cars/widgets)
 get('/cars/{id}')
 
 put('/cars/{id}')

 post('/cars/')

 delete('/cars/{id}')
            
 get('/brands/')
 get('/brands/list')
 
 post('/')

### 💻 Run Web Project

<p align="center">
   <img src="/github/vue.png" width="190" height="auto">
</div>

```bash
# Go to web folder
$ cd web

# Install Dependencies
$ yarn install

# Run Aplication
$ yarn dev

# Conexão API
alterar const API_URL no process.dev.env.API_URL,
por padrão está setado "http://api.teste.local"
```
Go to http://localhost:8080/ to see the result.


# :closed_book: License

Released in 2020 :closed_book: License

Made with love by [Gabriel Santos](https://github.com/biandishilaji) 🚀.
This project is under the [MIT license](./LICENSE).
