<?php
        
    class user{
        private $UserId,$UserName,$UserMail,$UserPassword,$UserLevel,$UserActivation, $StreamUrl;
        
        public function getUserId(){
            return $this->UserId;
        }
        public function setUserId($UserId){
            $this->UserId=$UserId;
        }
        
        public function getUserName(){
            return $this->UserName;
        }
        public function setUserName($UserName){
            $this->UserName=$UserName;
        }
        
        public function getUserMail(){
            return $this->UserMail;
        }
        public function setUserMail($UserMail){
            $this->UserMail=$UserMail;
        }
                
        public function getUserPassword(){
            return $this->UserPassword;
        }
        public function setUserPassword($UserPassword){
            $this->UserPassword=$UserPassword;
        }
                
        public function getUserActivation(){
            return $this->UserActivation;
        }
        public function setUserActivation($UserActivation){
            $this->UserActivation=$UserActivation;
        }
        
		public function getLevel(){
            return $this->UserLevel;
        }
        public function setLevel($UserLevel){
            $this->UserLevel=$UserLevel;
        }
		
		public function getStreamUrl(){
            return $this->StreamUrl;
        }
        public function setStreamUrl($StreamUrl){
            $this->StreamUrl=$StreamUrl;
        }
		
		
		public function InsertUserInfo($UserInfo){
			include "conn.php";
			$req=$bdd->prepare("UPDATE users SET UserInfo='$UserInfo' WHERE UserId=:UserId");
            $req->execute(array(            
                'UserId'=>$this->getUserId()
            ));
		}
		
        public function setUrl($StrUrl){
            include "conn.php";
            $req=$bdd->prepare("UPDATE users SET StreamUrl=:StreamUrl WHERE UserMail=:UserMail");
            $req->execute(array(            
                'UserMail'=>$this->getUserMail(),
				'StreamUrl'=>$StrUrl
            ));
			
			if($StrUrl!=''){
			$Date=time();
			$req=$bdd->prepare("INSERT INTO lastair(StreamUrl, UserId, Date) VALUES(:StreamUrl, :UserId, :Date)");
			$req->execute(array(
				'StreamUrl'=>$StrUrl,
				'UserId'=>$this->getUserId(),
				'Date'=>$Date));
				}
        }
        
        public function getActivateLinkTable(){
            include "conn.php";
          
            $req = $bdd->prepare("SELECT Activation FROM users WHERE UserMail=:UserMail");
            $req->execute(array(            
                'UserMail'=>$this->getUserMail()
            ));
            while($data=$req->fetch()){
                $this->setUserActivation($data['Activation']);
                }
            
            return $this->UserActivation;
        }
        
       public function checkActivateLink($key){
            $real_key=$this->getActivateLinkTable($this->getUserMail());
            return $real_key==$key;
        }
        
        public function activateUser(){
            include "conn.php";
            $req=$bdd->prepare("UPDATE users SET Activation='' WHERE UserMail=:UserMail");
            $req->execute(array(            
                'UserMail'=>$this->getUserMail()
            ));
        }
        
        public function InsertUser(){
        include "conn.php";
            
            
            $req=$bdd->prepare("SELECT * FROM users WHERE UserMail=:UserMail"); //проверка на существующий e-mail
			$req->execute(array(            
                'UserMail'=>$this->getUserMail()
            ));
            if($req->rowCount()!==0){
            
                header("Location: ../index.php?message=5"); 
			} else {
			
			$activation=$this->getUserActivation();
            $UserMail=$this->getUserMail();
			$headers = "From: 24concert <support@ibr.zzz.com.ua>";
            mail("$UserMail","24concert Активация аккаунта",
			"Активируйте аккаунт, нажав на ссылку: 
			ibr.zzz.com.ua/pages/act.php?usermail=$UserMail&key=$activation \nПоддержка support@24concert.com или vk.vom/ibrus",$headers);
			
			$req=$bdd->prepare("INSERT INTO users(UserName,UserMail,UserPassword,Activation,Level) VALUES(:UserName,:UserMail,:UserPassword,:Activation,1)");
            $req->execute(array(
                'UserName'=>$this->getUserName(), 
                'UserMail'=>$this->getUserMail(), 
                'UserPassword'=>$this->getUserPassword(),
                'Activation'=>$this->getUserActivation()
            ));
			header ("Location: ../index.php?message=3");
				}
            }
        
        public function UserLogin(){
        
            include "conn.php";
            $req = $bdd->prepare("SELECT * FROM users WHERE UserMail=:UserMail AND UserPassword=:UserPassword");
            $req->execute(array(            
                'UserMail'=>$this->getUserMail(),
                'UserPassword'=>$this->getUserPassword()
            ));
            if($req->rowCount()==0){
            
                header("Location: ../index.php?message=1");
                return false;
            } 
            else {
                $data=$req->fetch();
                if ($data['Activation']!=""){
                    header("Location: ../index.php?message=2");
                    return false;
                    
                } else {
                 
                    $this->setUserId($data['UserId']);
                    $this->setUserName($data['UserName']);
                    $this->setUserMail($data['UserMail']);
					$this->setLevel($data['Level']);
                    header("Location: ../main.php");
                    return true;
                
                }
            }
        }
        
        public function goPro(){
            $UserName = $this->getUserName();
            $UserMail = $this->getUserMail();
            $UserId = $this->getUserId();
            $UserSkype = $this->getStreamUrl();
            mail("ibrus.rus@gmail.com","Заявка на статус Pro","Заявка от $UserName <$UserMail>. \nSkype: $UserSkype \nАктивация Pro статуса: \n24concert.com/pages/makepro.php?usermail=$UserMail&id=$UserId");
            }
        
        public function makePro(){
            $UserMail = $this->getUserMail();
            
            include "conn.php";
            
            $req = $bdd->prepare("UPDATE users SET Level='2' WHERE UserMail=:UserMail");
            $req->execute(array(            
                'UserMail'=>$this->getUserMail()
            ));
            }
        
    }

    class chat {
        private $ChatId,$ChatUserId,$ChatText,$ChatRoom;
        
        public function getChatId(){
            return $this->ChatId;        
        }
        public function setChatId($ChatId){
            $this->ChatId = $ChatId;
        }
        
        public function getChatUserId(){
            return $this->ChatUserId;        
        }
        public function setChatUserId($ChatUserId){
            $this->ChatUserId = $ChatUserId;
        }
        
        public function getChatText(){
            return $this->ChatText;        
        }
        public function setChatText($ChatText){
            $this->ChatText = $ChatText;
        }
        
        public function getChatRoom(){
            return $this->ChatRoom;        
        }
        public function setChatRoom($ChatRoom){
            $this->ChatRoom = $ChatRoom;
        }
        
        public function InsertChatMessage(){
        
            include "conn.php";
			$date = time();
            $req = $bdd->prepare("INSERT INTO chat(ChatUserId,ChatText,ChatRoom,ChatDate) VALUES(:ChatUserId,:ChatText,:ChatRoom,:ChatDate)");
            $req->execute(array(
                'ChatUserId'=>$this->getChatUserId(),
                'ChatText'=>$this->getChatText(),
				'ChatRoom'=>$this->getChatRoom(),
				'ChatDate'=>$date
            ));
            
        }
            
        public function DisplayMessage(){
                include "conn.php";
                $room=$this->getChatRoom();
                $ChatReq=$bdd->prepare("SELECT * FROM chat WHERE ChatRoom=:room ORDER BY ChatDate");
                $ChatReq->execute(array('room'=>$room));
                
                while($DataChat= $ChatReq->fetch()){
                
                    $UserReq=$bdd->prepare("SELECT * FROM users WHERE UserId=:UserId");
                    $UserReq->execute(array(
                    
                        'UserId'=>$DataChat['ChatUserId']
                        
                    ));
                $DataUser = $UserReq->fetch();
                ?>
                <span class="UserNameS"><?php echo $DataUser['UserName']." (".date('H:i d.m', $DataChat['ChatDate']).")"; ?></span>:<br/>
                <div class="ChatMessage"><?php echo $DataChat['ChatText']; ?></div></br></br>
                <?php
                }
            }
    }

?>