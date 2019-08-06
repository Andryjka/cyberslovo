<?

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Insiders extends Model
{
	protected $table = 'insiders';

	protected $fillable = ['title', 'author', 'description', 'created_by', 'modified_by'];

}