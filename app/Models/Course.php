<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\Statement;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'courses';

    protected $keyType = 'string';

    protected $fillable = ['id', 'name', 'teacher', 'exam'];

    /**
     * @throws Exception
     */
    public static function parseCsvAndStore($file)
    {
        if (!$file->isValid()) {
            throw new Exception('Invalid file upload.');
        }

        // Get the real path of the uploaded file
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0);
        $stmt = Statement::create();
        $records = $stmt->process($csv);

        DB::beginTransaction();
        try {
            foreach ($records as $record) {
                self::create([
                    'id' => $record['id'],
                    'name' => $record['Курс'] ?? null,
                    'teacher' => $record['контактное лицо'] ?? null,
                    'exam' => isset($record['экзамен конец']) ? date('Y-m-d', strtotime($record['экзамен конец'])) : null,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
