<?php
function tail_achievements()
{
    global $pdo;
    try
    {
        $sql= "SELECT * FROM union_achievements_FULL ORDER BY ts DESC";
        $rs= $pdo->query($sql);
        $rs->setFetchMode(PDO :: FETCH_ASSOC);
        $reports= $rs->fetchAll();
    }
    catch (PDOException $exception)
    {
        print "\nException: " . $exception->getMessage();
    }
    return $reports;
}

function get_vulns()
{
    global $pdo;
    try
    {
        $sql= "SELECT * FROM vulns_FULL WHERE status!='PENDING'";
        $rs= $pdo->query($sql);
        $rs->setFetchMode(PDO :: FETCH_ASSOC);
        $reports= $rs->fetchAll();
    }
    catch (PDOException $exception)
    {
        print "\nException: " . $exception->getMessage();
    }
    return $reports;
}

function get_hints($category=NULL,$usertype=NULL)
{
    global $pdo;
    try
    {
        $sql= "SELECT * FROM hint WHERE ( usertype='both' OR usertype='$usertype')";
        if($category!=null)
            $sql.=" AND category='$category'";
        
        $rs= $pdo->query($sql);
        $rs->setFetchMode(PDO :: FETCH_ASSOC);
        $reports= $rs->fetchAll();
    }
    catch (PDOException $exception)
    {
        print "\nException: " . $exception->getMessage();
    }
    return $reports;

}

function add_claim($treasure,$id)
{
    global $pdo;
    try
    {
        $sql='INSERT INTO users_treasures (treasures_id,users_id) values (:treasure,:user)';
        $stmt= $pdo->prepare($sql);
        $stmt->bindValue(':user', $id);
        $stmt->bindValue(':treasure', $treasure['id']);
        $pdo->beginTransaction();
        if($stmt->execute())
          $pdo->commit();
        
    }
    catch (PDOException $exception)
    {
        switch($stmt->errorCode())
        {
            case 23000:
                // Duplicate claim
                print "\nException [CODE:".$stmt->errorCode()."]: " . $exception->getMessage();
                return -1;
                break;
            default:
                print "\nException [CODE:".$stmt->errorCode()."]: " . $exception->getMessage();
                return false;
        }
    }
    return true;
    
}
function get_achievements()
{
    global $id,$pdo;
    $res=array('ts' => '', 'name' => 'No achievements yet...','points'=>0);
    $sql="SELECT * FROM uid_achievements WHERE users_id=:id ORDER BY ts DESC";
    try
    {

        $stmt= $pdo->prepare($sql);
        $stmt->bindValue(':id',intval($id));
        $stmt->execute();
        $stmt->setFetchMode(PDO :: FETCH_ASSOC);
        $res=$stmt->fetchAll();
        if($res==null | $res===false)
            return false;
    }
    catch (PDOException $exception)
    {
        print "\nException: " . $exception->getMessage();
    }
    return $res;

}
function claim_achievement()
{
    global $id,$pdo;
    
    if (trim($_POST['code'])=='' || intval($id)==0)  return false;
    $code=trim($_POST['code']);
    $res=null;
    try
    {

        $sql= "SELECT * FROM treasures WHERE code=:code LIMIT 1";
        $stmt= $pdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();
        $stmt->setFetchMode(PDO :: FETCH_ASSOC);
        $res=$stmt->fetch();
        if($res==null | $res===false)
        {
            echo 'Nothing to claim here... Move along!';
            return false;
        }
        //printf("Found Treasure %d: %s\n",$res['id'],$res['title']); 
        $ac=add_claim($res,$id);
        if($ac!==true)
            return $ac;
    }
    catch (PDOException $exception)
    {
        print "\nException: " . $exception->getMessage();
    }
        return $res;
}

function get_all_reports()
{
    global $pdo;
    try
    {
        $sql= "SELECT * FROM reports_with_fqdn";
        $rs= $pdo->query($sql);
        $rs->setFetchMode(PDO :: FETCH_ASSOC);
        $reports= $rs->fetchAll();
    }
    catch (PDOException $exception)
    {
        print "\nException: " . $exception->getMessage();
    }
    return $reports;
    
}
function tohtml($str)
{
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}

function get_scores($what= 'hackers')
{
    global $pdo;
    return;
}

function get_reports($mac= NULL, $user= 'admin')
{
    global $pdo;
    try
    {
            $sql= "SELECT * FROM reports_with_fqdn";
        if ($user == 'admin')
            $sql .= " WHERE reporter_mac='$mac'";
        else
            $sql .= " WHERE hacker_mac='$mac'";


        $rs= $pdo->query($sql);
        $rs->setFetchMode(PDO :: FETCH_ASSOC);
        $reports= $rs->fetchAll();
    }
    catch (PDOException $exception)
    {
        print "\nException: " . $exception->getMessage();
    }
    return $reports;
}

function add_report()
{
    global $pdo, $id;
    if (intval($id) <= 0)
        return;
    $subject= trim(@ $_POST['subject']);
    $attacker= trim(@ $_POST['attacker']);
    $server= trim(@ $_POST['server']);
    $abuse= trim(@ $_POST['abuse']);
    $message= trim(@ $_POST['message']);
    $datentime= trim(@ $_POST['datentime']);
    $logs= trim(@ $_POST['logs']);
    $thru= trim(@ $_POST['thru']);
    try
    {

        /* create a prepared statement */
        $QUERY= "INSERT INTO reports (reporter,datentime,subject,attacker,server,abuse,message,logs,thru) VALUES (:reporter,:datentime,:subject,:attacker,:server,:abuse,:message,:logs,:thru)";
        $stmt= $pdo->prepare($QUERY);

        /* bind the parameter */
        $stmt->bindValue(':reporter', $id);
        $stmt->bindValue(':subject', $subject);
        $stmt->bindValue(':datentime', $datentime);
        $stmt->bindValue(':attacker', $attacker);
        $stmt->bindValue(':server', $server);
        $stmt->bindValue(':abuse', $abuse);
        $stmt->bindValue(':message', $message);
        $stmt->bindValue(':logs', $logs);
        $stmt->bindValue(':thru', $thru);

        $pdo->beginTransaction();
        /* execute the SQL */
        if ($stmt->execute())
        {
            echo 'Your Abuse Report has been registered [' . $pdo->lastInsertId() . ']';
            $pdo->commit();
        }
        else
        {
            print_r($pdo->errorInfo());
        }
    }
    catch (PDOException $exception)
    {
        print "\nException: " . $exception->getMessage();
        $pdo->rollBack();
    }
}


function add_vuln()
{
    global $pdo, $id;
    if (intval($id) <= 0)
        return;
    $subject= trim(@ $_POST['subject']);
    $server= trim(@ $_POST['server']);
    $subject= trim(@ $_POST['subject']);
    $message= trim(@ $_POST['message']);
    try
    {

        /* create a prepared statement */
        $QUERY= "INSERT INTO vuln (users_id,subject,server,message) VALUES (:reporter,:subject,:server,:message)";
        $stmt= $pdo->prepare($QUERY);

        /* bind the parameter */
        $stmt->bindValue(':reporter', $id);
        $stmt->bindValue(':subject', $subject);
        $stmt->bindValue(':server', $server);
        $stmt->bindValue(':message', $message);

        $pdo->beginTransaction();
        /* execute the SQL */
        if ($stmt->execute())
        {
            echo 'Your Vulnerability Report has been registered [' . $pdo->lastInsertId() . ']';
            $pdo->commit();
        }
        else
        {
            print_r($pdo->errorInfo());
        }
    }
    catch (PDOException $exception)
    {
        print "\nException: " . $exception->getMessage();
        $pdo->rollBack();
    }
}

function do_cmd()
{
}

function srv_admin($username,$password)
{
    $username = preg_replace("/[^a-zA-Z0-9]/", "", $username);
    $username= preg_replace('/[^[:print:]]/', '',$username);
    // Connect to PBX 
    // Insert into 
    
}