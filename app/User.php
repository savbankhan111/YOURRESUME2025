<?php

namespace App;

use App\Models\Appointment;
use App\Models\Education;
use App\Models\Experience;
use App\Models\SchoolData;
use App\Models\UserDocuments;
use App\Models\UserResume;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\InterviewerSlotsBooked;
use App\Models\InterviewerSlot;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'industry_id','first_name', 'last_name', 'email','email_verified_at','email_verified_code','status', 'fcm_token', 'password', 'account_status', 
		'notification_status', 'image', 'id_card_verification', 'remember_token','point'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
	
	public function indData(){
        return $this->hasOne('App\Models\Industry', 'id', 'industry_id');
    }
	
	 public function industryData()
    {
        return $this->hasOne('App\Models\IndustriesUser', 'user_id', 'id');
    }
	
	 public function professional()
    {
        return $this->hasOne('App\Models\Professional', 'user_id', 'id');
    }
	
	 public function student()
    {
        return $this->hasOne('App\Models\Student', 'user_id', 'id');
    }
	
	 public function employerInfo()
    {
        return $this->hasOne('App\Models\Employer', 'user_id', 'id');
    }
	
	 public function userOrder()
    {
        return $this->hasMany('App\Models\Order')->orderBy('end_date', 'desc');
    }
	
	public function paymentStatus(){ 
        return $this->userOrder()->where("end_date", '>=', date('Y-m-d'));
    }
	
	public function managerdata(){
        return $this->hasOne('App\Models\ManagerUser', 'user_id', 'id');
    }
	
	public function userInfo(){
        return $this->hasOne('App\Models\UserProfile', 'user_id', 'id');
    }
	
	public function userAddress(){
        return $this->hasOne('App\Models\UserAddress', 'user_id', 'id');
    }

    public function checkRole($rolename)
    {
        foreach ($this->roles()->get() as $role) {
            if ($role->roles == $rolename) {
                return true;
                break;
            }
        }

        return false;
    }

     public function getCountBooked()
    {
        return $this->hasMany(InterviewerSlotsBooked::class, "manager_id", "id");
    }

    public function timeSlot()
    {
        return $this->hasOne(InterviewerSlot::class,"manager_id","id");
    }
    
    public function jobsApplied(){
        return $this->belongsToMany('App\Models\Job',"job_users","user_id","job_id");
    }
    
    
    
        public function language()
    {
        return $this->belongsToMany('App\Models\Languages', 'language_fields', 'type_id', 'lang_id');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Models\Skill', 'skill_fields', 'job_id', 'skill_id')->where("type", "user");
    }

    public function resume(){
        return $this->hasOne(UserResume::class, "user_id");
    }

    public function experience()
    {
        return $this->hasMany(Experience::class, "user_id");
    }

    public function education()
    {
        return $this->hasMany(SchoolData::class, "user_id");
    }

    public function documents()
    {
        return $this->hasMany(UserDocuments::class, "user_id");
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class, "user_id");
    }

    public function scopeFilter($query, $arr)
    {
        $list = $this->checkResume($query, $arr) ? :$query;
       return $this->allData($list);
    }

    public function scopeResumeUserData($query)
    {
            return $this->allData($query);
    }


    /**
     * @param $query
     * @param $arr
     * @return string
     */
    public function checkResume($query, $arr)
    {
        $list = "";
        foreach ($arr as $key => $val) {
            if ($val !== null && $val != "") {
                $list = $query->whereHas("appointment", function ($q) use ($key, $val) {
                    if ($key == "language" || $key == "skills") {
                        $q->where($key, 'REGEXP', "[[:<:]]" . $val . "[[:>:]]");
                    } else {
                        $q->where($key, $val);
                    }
                });

            }

        }
        return $list;
    }

    /**
     * @param string $list
     */
    public function allData($list)
    {
      return $list->with(["language", "resume", "experience", "education", "skills", "documents"]);
    }

}