<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            "name" => "admin",
        ]);
        Role::create([
            "name" => "kantin",
        ]);
        Role::create([
            "name" => "bank",
        ]);
        Role::create([
            "name" => "siswa",
        ]);

        Category::create([
            "name" => "minuman"
        ]);
        Category::create([
            "name" => "makanan"
        ]);
        Category::create([
            "name" => "pakaian"
        ]);

        User::create([
            "name" => "raya",
            "password" => "123",
            "roles_id" => 1,

        ]);
        User::create([
            "name" => "iksan",
            "password" => "678",
            "roles_id" => 2,

        ]);
        User::create([
            "name" => "rizki",
            "password" => "999",
            "roles_id" => 3,

        ]);
        User::create([
            "name" => "rapael",
            "password" => "890",
            "roles_id" => 4,

        ]);
        User::create([
            "name" => "faris",
            "password" => "345",
            "roles_id" => 4,

        ]);

        Product::create([
            "name" => "lemon ice tea",
            "price" => 5000,
            "stock" => 100,
            "photo" => "/photos/lemon.png",
            "description" => "description lemon es rrq lemon",
            "categories_id" => 1,
            "stand" => 2,
            "created_at" => "2023-10-25 01:50:58"
        ]);
        Product::create([
            "name" => "bakso",
            "price" => 10000,
            "stock" => 50,
            "photo" => "/photos/bakso.png",
            "description" => "description bakso evos bakso",
            "categories_id" => 2,
            "stand" => 1,
            "created_at" => "2023-10-25 01:50:59"
        ]);
        Product::create([
            "name" => "celana hypebeast",
            "price" => 500000,
            "stock" => 15,
            "photo" => "/photos/clg3.png",
            "description" => "description celana hypebeast evos celana hypebeast",
            "categories_id" => 3,
            "stand" => 4,
            "created_at" => "2023-10-25 01:50:51"
        ]);
        Product::create([
            "name" => "baju hypebeast",
            "price" => 3000,
            "stock" => 10,
            "description" => "description baju hypebeast evos baju hypebeast",
            "photo" => "/photos/clg2.png",
            "categories_id" => 3,
            "stand" => 4,
            "created_at" => "2023-10-25 01:50:52"
        ]);
        Product::create([
            "name" => "topi hypebeast",
            "price" => 200000,
            "stock" => 60,
            "description" => "description topi hypebeast evos topi hypebeast",
            "photo" => "/photos/clg1.png",
            "categories_id" => 3,
            "stand" => 4,
            "created_at" => "2023-10-25 01:50:40"
        ]);

        Wallet::create([
            "users_id" => 4,
            "credit" => 100000,
            "debit" => NULL,
            "status" => "selesai"
        ]);
        Wallet::create([
            "users_id" => 4,
            "credit" => NULL,
            "debit" => 15000,
            "status" => "selesai"
        ]);
    }
}
