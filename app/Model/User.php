<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * Class User
 * @package App\Model\
 *
 * @property $id
 * @property-write $password
 * @property-write $name
 * @property-write $email
 */
class User extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'email',
        'password',
        'name',
        'created_at'
    ];

    public static function getByEmail(string $email)
    {
        return self::query()->where('email', '=', $email)->first();
    }

    public static function getById(int $id)
    {
        return self::query()->find($id);
    }

    public static function getList(int $limit = 10, int $offset = 0)
    {
        return self::query()->limit($limit)->offset($offset)->orderBy('id', 'DESC')->get();
    }

    public static function getPasswordHash(string $password)
    {
        return sha1(',.tj+gtf' . $password);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name) : string
    {
        $this->name = $name;
        return self;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function isAdmin(): bool
    {
        return in_array($this->id, ADMIN_IDS);
    }

}