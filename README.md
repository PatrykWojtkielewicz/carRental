## Table of contents
* [Authentication](#authentication)
* [Renting cars](#renting-cars)
* [Rented cars](#rented-cars)
* [Users](#users)
* [Other](#other)

## Authentication
Available only for **unauthenticated users**:
* Register (post) -> register -> name, email, surname, password
* Login (post) -> login ->email, password
Available only for authenticated users:
* Logout (post) -> logout


## Renting cars
Available only for **authenticated users**:
* Rent (get) -> index
* Rent (post) -> store -> car_id, rental_date, return_date

## Rented cars
Available only for **admins**:
* Rented (get) -> index
* Rented (get) -> show -> id
    * ``` api/rented/1 ```
* Rented (put) -> update -> id
    * ``` api/rented/1 ```
* Rented (delete) -> destroy -> id
    * ``` api/rented/1 ```
* Rented (get) -> search -> brand
    * Searching available both by id and by brand name
    * ``` api/rented/search/1 ```
    * ``` api/rented/search/Volkswagen ```


## Users
Available only for **admins**:
* Users (get) -> index
* Users (get) -> search -> name
    * ``` api/users/search/xyz ```
* Users (post) -> store -> name, surname, email, password
* Users (get) -> show -> id
    * ``` api/users/1 ```
* Users (put) -> update -> id
    * ``` api/users/1 ```
* Users (delete) -> destroy -> id
    * ``` api/users/1 ```

## Other
Available only for **admins**:
* Overdue (get) -> index