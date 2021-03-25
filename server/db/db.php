<?php
class Db{
  	var $db;
  	var $server_name="localhost";
  	var $db_name="dbname";
  	var $db_username="dbuser";
	var $db_pwd="dbpwd";
  	
  	//var $campus=array('全部校区','东部校区', '白杨校区');
  	//var $grade=array('全部','高一', '高二', '高三');
  	//var $gclass=array('全部','一班', '二班', '三班', '四班', '五班', '六班', '七班', '八班', '九班', '十班', '十一班', '十二班');
  	//数据库链接 1成功 0失败
  	function open(){
    	$this->db=new mysqli($this->server_name,$this->db_username,$this->db_pwd,$this->db_name);
      	if (($this->db)->connect_error) {
   			return false;
		} 
		return true;
    }
  	//数据库关闭
  	function close(){
    	($this->db)->close();
    }
  	function checkClassToken($token){
    	$sql="SELECT class_name FROM class_list WHERE token='".$token."'";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return true;
		} else {
    		return false;
		}    	
    }
	function classTokenToName($token){
    	$sql="SELECT class_name FROM class_list WHERE token='".$token."'";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return ($result->fetch_all())[0][0];
		} else {
    		return false;
		}
    }
  	function classTokenToID($token){
    	$sql="SELECT id FROM class_list WHERE token='".$token."'";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return ($result->fetch_all())[0][0];
		} else {
    		return false;
		}
    }
  	function classIndexToID($campus,$grade,$class){
    	$sql="SELECT id FROM class_list WHERE campus='".$campus."' AND grade='".$grade."' AND class='".$class."'";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return ($result->fetch_all()[0][0]);
		} else {
    		return false;
		}
    }

  	//发送指令到班牌 receiver为班级id
	function sendCommand($type,$typeid,$receiver){
    	$sql="INSERT INTO command_stat (type,typeid,receiver) VALUES ('".$type."','".$typeid."','".$receiver."')";
      	if (($this->db)->query($sql) === TRUE) {
            return mysqli_insert_id($this->db);
		} else {
    		return false;
		}
    }
  	//班牌已读指令标记
  	function readCommand($id,$receiver){
    	$sql="UPDATE command_stat SET isreceived=true WHERE id='".$id."' AND receiver='".$receiver."'";
      	if (($this->db)->query($sql) === TRUE) {
    		return true;
		} else {
    		return false;
		}
    }
  	//班牌未读指令查询
  	function searchCommand($receiver){
    	$sql="SELECT * FROM command_stat WHERE receiver='".$receiver."' AND isreceived=false";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return $result->fetch_all();
		} else {
    		return false;
		}
    }
  	//老师未读指令查询
  	function searchTeacherCommand($teacher_id){
    	$sql="SELECT * FROM teacher_command_stat WHERE teacher_id='".$teacher_id."' AND isreceived=false";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return $result->fetch_all();
		} else {
    		return false;
		}
    }
  	//老师已读指令标记
  	function readTeacherCommand($id,$teacher_id){
    	$sql="UPDATE teacher_command_stat SET isreceived=true WHERE id='".$id."' AND teacher_id='".$teacher_id."'";
      	if (($this->db)->query($sql) === TRUE) {
    		return true;
		} else {
    		return false;
		}
    }
  	function modifyTeacherCommandByType($type,$typeid,$teacher_id,$value){
    	$sql="UPDATE teacher_command_stat SET isreceived=".$value." WHERE type='".$type."' AND typeid='".$typeid."'";
      	if (($this->db)->query($sql) === TRUE) {
    		return true;
		} else {
    		return false;
		}
    }
  	//给老师发送消息
  	function sendCommandToTeacher($type,$typeid,$teacher_id,$information){
    	$sql="INSERT INTO teacher_command_stat (type,typeid,teacher_id,information) VALUES ('".$type."','".$typeid."','".$teacher_id."','".$information."')";
      	if (($this->db)->query($sql) === TRUE) {
            return mysqli_insert_id($this->db);
		} else {
    		return false;
		}
    }
  	//发送通知消息
 	function sendMessage($sendto,$emergency,$title,$message,$images,$teacher_id){

    	$sql="INSERT INTO messages (sendto,emergency,title,message,images,teacher_id) VALUES ('".$sendto."','".$emergency."','".$title."','".$message."','".$images."','".$teacher_id."')";
      	if (($this->db)->query($sql) == TRUE) {
           $messageid=mysqli_insert_id($this->db);
          	$this->sendCommand('messages',$messageid,$sendto);
          return $messageid;
		}else{
			return false;
        }
    }
  //按老师号查询未处理请假申请
  function queryUndealLeave($teacherid){
    $sql="SELECT a.tag,a.reason,a.iscontact,a.time_begin,a.time_end,a.stat,b.student_name,a.id FROM leave_school a,student_list b,teacher_list c WHERE a.stat=0 AND a.teacher_id=c.teacher_id AND a.stu_id=b.student_id AND a.teacher_id='".$teacherid."'";
      $result = ($this->db)->query($sql);
      if ($result->num_rows > 0) {
    	return $result->fetch_all();
	} else {
    	return false;
	}  
  }
  //按老师号查询未处理请假申请
  function queryHistoryLeave($teacherid){
    $sql="SELECT a.tag,a.reason,a.iscontact,a.time_begin,a.time_end,a.stat,b.student_name,a.id FROM leave_school a,student_list b,teacher_list c WHERE a.teacher_id=c.teacher_id AND a.stu_id=b.student_id AND a.teacher_id='".$teacherid."' LIMIT 50";
      $result = ($this->db)->query($sql);
      if ($result->num_rows > 0) {
    	return $result->fetch_all();
	} else {
    	return false;
	}  
  }
  //处理请假申请
  function dealLeaveRequest($id,$result){
  	$sql="UPDATE leave_school SET stat=".$result." WHERE id='".$id."'";
    	if (($this->db)->query($sql) === TRUE) {
    		return true;
		} else {
    		return false;
		}
  }
  //增加请假申请
  function insertLeave($stu_id,$type,$reason,$iscontact,$time_begin,$time_end,$stat,$teacher_id){
  	$sql="INSERT INTO leave_school (stu_id,tag,reason,iscontact,time_begin,time_end,stat,teacher_id) VALUES ('".$stu_id."','".$type."','".$reason."','".$iscontact."','".$time_begin."','".$time_end."','".$stat."','".$teacher_id."')";
    	if (($this->db)->query($sql) === TRUE) {
        	$id=mysqli_insert_id($this->db);
          	$this->sendCommandToTeacher("leave",$id,$teacher_id,"有新的请假待审核");
          	return $id;
		}else{
			return false;
        }
  }
  function initChickList(){
  	$data=array();
	$sql="SELECT * FROM school_inf WHERE receiver='".$receiver."' AND isreceived=false";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return $result->fetch_all();
		}    
  }
  //根据校区和年级初始化可选班级
  function initChickListClass($campus,$grade){
      $class=array();
    	$display=array();
  	$sql="SELECT b.id,a.name FROM school_inf a,class_list b WHERE a.type='"."class"."' AND a.typeid=b.class AND b.grade='".$grade."' AND b.campus='".$campus."'";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
           $a=$result->fetch_all();
          for($x=0;$x<$result->num_rows;$x++){
          	$classdata=array(
            	"classid"=>$a[$x][0],
              	"classname"=>$a[$x][1]
            );
           array_push($class,$classdata);
           array_push($display,$a[$x][1]);
          }
		}
    $class['display']=$display;
    return $class;
  }
  //根据校区初始化可选年级
  function initChickListGrade($campus){
      $grade=array();
    	$display=array();
  	$sql="SELECT a.name,a.typeid FROM school_inf a,class_list b WHERE a.type='"."grade"."' AND b.campus='".$campus."' AND a.typeid=b.grade";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
          $a=$result->fetch_all();
          $gradename="";
          for($x=0;$x<$result->num_rows;$x++){
            if($a[$x][0]==$gradename){
            	continue;
            }else{
            	$gradename=$a[$x][0];
            }
          	$gradedata=array(
              	"gradeid"=>$a[$x][1],
              	"gradename"=>$a[$x][0]
            );
           array_push($display,$a[$x][0]);
           array_push($grade,$gradedata);
          }
		}
    $grade['display']=$display;
              return $grade;
  }
  //初始化可选校区
  function initChickListCampus(){
    $campus=array();
    $display=array();
  	$sql="SELECT a.name,a.typeid FROM school_inf a,class_list b WHERE a.type='"."campus"."' AND b.campus=a.typeid";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
          $a=$result->fetch_all();
          $campusname="";
          for($x=0;$x<$result->num_rows;$x++){
             if($a[$x][0]==$campusname){
            	continue;
            }else{
            	$campusname=$a[$x][0];
            }
          	$campusdata=array(
            	"campusid"=>$a[$x][1],
              	"campusname"=>$a[$x][0]
            );
            array_push($display,$a[$x][0]);
           array_push($campus,$campusdata);
          }
		}
     $campus['display']=$display;
              return $campus;
  }
  //根据班级和星期返回对应课表
  function getClassTable($classid,$week){
  	$sql="SELECT classList FROM classtable WHERE classID='".$classid."' AND week=".$week;
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return $result->fetch_all();
		} else {
    		return false;
		}
  }
  //获取所有可选的课程信息
  function getClassType(){
    $display=array();
  	$sql="SELECT * FROM classtable_type";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		$a=$result->fetch_all();
          	for($x=0;$x<$result->num_rows;$x++){
            array_push($display,$a[$x][1]);
          }
        	return $display;
		} else {
    		return false;
		}
  }
  //添加课程表json
  function insertClassTable($classid,$week,$classtable){
	$sql="SELECT classList FROM classtable WHERE classID='".$classid."' AND week=".$week;
    $result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
          $sql="UPDATE classtable SET classList='".$classtable."' WHERE classID='".$classid."' AND week='".$week."'";
      	if (($this->db)->query($sql) === TRUE) {
    		return true;
		} else {
    		return false;
		}
    		
		} else {
    	$sql1="INSERT INTO classtable (classList,classID,week) VALUES ('".$classtable."','".$classid."','".$week."')";
      	if (($this->db)->query($sql1) === TRUE) {
            return mysqli_insert_id($this->db);
		} else {
    		return false;
		}
		}
  }
   //根据班级和星期返回对应值日表
  function getCleanTable($classid,$week){
  	$sql="SELECT cleanList FROM cleantable WHERE classID='".$classid."' AND week=".$week;
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return $result->fetch_all();
		} else {
    		return false;
		}
  }
  //添加班级值日表json
  function insertCleanTable($classid,$week,$cleantable){
	$sql="SELECT cleanList FROM cleantable WHERE classID='".$classid."' AND week=".$week;
    $result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
          $sql="UPDATE cleantable SET cleanList='".$cleantable."' WHERE classID='".$classid."' AND week='".$week."'";
      	if (($this->db)->query($sql) === TRUE) {
    		return true;
		} else {
    		return false;
		}
    		
		} else {
    	$sql1="INSERT INTO cleantable (cleanList,classID,week) VALUES ('".$cleantable."','".$classid."','".$week."')";
      	if (($this->db)->query($sql1) === TRUE) {
            return mysqli_insert_id($this->db);
		} else {
    		return false;
		}
		}
  }
  //根据classid查询扣分信息
  function queryCleanScoreContext($classid){
  		$sql="SELECT a.*,b.student_name,c.class_name FROM clean_score a, student_list b,class_list c WHERE a.classid='".$classid."' AND a.week_student_id=b.student_id AND a.week_class_id=c.id ORDER BY a.time DESC LIMIT 50";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return $result->fetch_all();
		} else {
    		return false;
		}
  }
  //查询appsecret合法性
  function validToken($appsecret){
  		$sql="SELECT * FROM admin_login WHERE appsecret='".$appsecret."'";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return true;
		} else {
    		return false;
		}
  }
  //查询有无权限openid
    function queryOpenidInAdminList($openid){
  		$sql="SELECT * FROM admin_login WHERE wx_openid='".$openid."'";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return true;
		} else {
    		return false;
		}
  }
  //添加老师
  function insertTeacherToAdminList($teacherid,$teachername,$teacherwxopenid,$teacherwxunionid,$teacherwxsesson,$teacherappsecret){
    if($this->queryOpenidInAdminList($openid)){
    	return true;
    }
  	$sql1="INSERT INTO teacher_list (teacher_id,teacher_name) VALUES ('".$teacherid."','".$teachername."')";
      	if (($this->db)->query($sql1) === TRUE) {
            $sql2="INSERT INTO admin_login (wx_openid,wx_unionid,teacher_id,wx_session_key,appsecret) VALUES ('".$teacherwxopenid."','".$teacherwxunionid."','".$teacherid."','".$teacherwxsesson."','".$teacherappsecret."')";
          	if (($this->db)->query($sql2) === TRUE) {
            	return true;
            }else{
            	return false;
            }
		} else {
    		return false;
	}
  }
  //获取管理员相关信息
  function getAdminInformation($openid){
  	$sql = "SELECT a.appsecret,b.teacher_name,b.teacher_id FROM admin_login a,teacher_list b WHERE a.wx_openid='".$openid."' AND a.teacher_id=b.teacher_id";
    $result=($this->db)->query($sql);
    	if ($result->num_rows > 0) {
    		$res=$result->fetch_all();
          	$appsecret=$res[0][0];
          	$teacher_name=$res[0][1];
          	$teacherid=$res[0][2];
          	$sql2 = "SELECT id,class_name FROM class_list WHERE teacher_id='".$res[0][2]."'";
          $result2=($this->db)->query($sql2);
    			if ($result2->num_rows > 0) {
            		$a=$result2->fetch_all();
                  	$isClassAdmin=1;
                  	$classID=$a[0][0];
                    $className=$a[0][1];
            	}else{
                	$isClassAdmin=0;
                  	$classID="0";
                  	$className="";
                }
          $data=array(
            "appsecret"=>$appsecret,
          	"teacher_id"=>$teacherid,
            "teacher_name"=>$teacher_name,
            "isClassAdmin"=>$isClassAdmin,
            "classID"=>$classID,
            "className"=>$className
          );
          return $data;
		} else {
    		return array();
		}
  }
  //管理员信息更新
	function updateAdminLoginStatus($openid,$sessionkey,$appsecret){
  	$sql="UPDATE admin_login SET wx_session_key='".$sessionkey."',appsecret='".$appsecret."' WHERE wx_openid='".$openid."'";
      	if (($this->db)->query($sql) === TRUE) {
    		return true;
		} else {
    		return false;
		}
  }
	//获取上课时间表
  function getClassTime(){
  	$sql="SELECT * FROM classtable_time";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return $result->fetch_all();
		} else {
    		return false;
		}
  }
  //获取班牌基本信息
    function getClassInf($classid){
  	$sql="SELECT a.class_name,b.teacher_name FROM class_list a,teacher_list b,school_inf c WHERE a.id='".$classid."' AND a.teacher_id=b.teacher_id";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return $result->fetch_all();
		} else {
    		return false;
		}
  }
  //获取班级消息列表 最大返回n条
  function queryClassMessage($classid,$max=6){
  		$sql="SELECT * FROM messages WHERE sendto='".$classid."' ORDER BY id DESC LIMIT ".$max."";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return $result->fetch_all();
		} else {
    		return false;
		}
  }
  //依据id获取详细信息
  function queryClassMessageByID($messageid){
  	$sql="SELECT * FROM messages WHERE id='".$messageid."'";
      	$result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return $result->fetch_all();
		} else {
    		return false;
		}
  }
  //获取学生详细信息
  function queryStudentInformation($studentid){
  	$sql="SELECT a.*,c.teacher_id FROM student_list a,class_list c WHERE a.student_id='".$studentid."' AND a.classid=c.id";
    $result = ($this->db)->query($sql);
      	if ($result->num_rows > 0) {
    		return $result->fetch_all();
		} else {
    		return false;
		}
  }
}

//$db=new Db;
//$db->open();
//print_r($db->queryOpenidInAdminList("oSdOa5SkcZBuTQCiQhj1OEVOnFzM"));
//$db->close();

?>