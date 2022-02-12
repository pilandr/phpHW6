<?php
namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    public $timestamps = false;
    protected $fillable = [
        'text',
        'author_id',
        'image',
        'created_at'
    ];

    public static function deleteMessage(int $messageId)
    {
        $message = self::query()->find($messageId);
        if ($message->image) {
            unlink(PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'html\upload' . DIRECTORY_SEPARATOR . $message->image);
     }
        return self::destroy($messageId);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public static function getList(int $limit = 10, int $offset = 0)
    {
        return self::with('author')->limit($limit)->offset($offset)->orderBy('id', 'DESC')->get();
    }

    public static function getUserMessages(int $userId, int $limit)
    {
        return self::query()->where('author_id', '=', $userId)->limit($limit)->get();
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
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return mixed
     */
    public function getAuthor_id()
    {
        return $this->author_id;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            $this->image = $this->genFileName();
            move_uploaded_file($file,getcwd() . '/upload/' . $this->image);
        }
    }

    private function genFileName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'author_id' => $this->author_id,
            'text' => $this->text,
            'created_at' => $this->created_at,
            'image' => $this->image
        ];
    }
}