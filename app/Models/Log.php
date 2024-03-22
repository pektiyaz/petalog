<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory, Filterable;

    public $head = [];
    public $typeData = [];
    public $data = [];
    protected $guarded = [];

    public function project(): BelongsTo{
        return $this->belongsTo(Project::class);
    }


    public function parse(): void{
        $message = trim($this->message);
        $message = preg_split('/\r\n|\r|\n/', $message);
        $this->head =  json_decode($message[0] ?? []) ;
        $this->typeData =  json_decode($message[1] ?? []) ;
        $this->data =  json_decode($message[2] ?? []) ;
    }
}
