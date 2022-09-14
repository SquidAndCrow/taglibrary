<?php

namespace App\Models;

use CodeIgniter\Model;

class CICOModel extends Model
{
    protected $table = 'checkin_checkout';
    protected $allowedFields = ['event_library_id', 'badge_hash', 'checkin', 'checkout'];
}