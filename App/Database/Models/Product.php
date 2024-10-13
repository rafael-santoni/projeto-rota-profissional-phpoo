<?php

namespace App\Database\Models;

class Product extends Model
{
  public static string $table = 'products';
  
  public readonly int $id;
  public readonly string $name;
  public readonly string $slug;
  public readonly int|float $price;
  public readonly string $image;
  public readonly string $description;
  public readonly string $created_at;
  public readonly string $updated_at;
}
