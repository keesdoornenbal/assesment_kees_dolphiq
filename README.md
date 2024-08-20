# Dolphiq shopping list

This is a project for a code assesment at dolphiq.  It's created as a test of the code skills of a potential new employee.

To start this project, do the following:


## Authors

- Kees Doornenbal


## Run Locally

Go to the project directory

Install docker if not already done, then install sail:

```bash
  composer require laravel/sail --dev
```

After Sail has been installed, you may run the sail:install Artisan command.

```bash
  php artisan sail:install
```

Finally, you may start Sail.
```bash
  ./vendor/bin/sail up
```

You should also create a database called "dolphiq_assessment", or another but give it the same name as in the .env file.
After that, you must run 

```bash
  ./vendor/bin/sail php artisan migrate
```