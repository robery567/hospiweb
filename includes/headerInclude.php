<?php 
if(!isset($_SESSION)) {
     session_start();
}
if (!isset($_SESSION['CNP'])){ echo'
<ul class="nav navbar-nav ml-auto">
    <li class="nav-item" role="presentation"><a class="nav-link active" href="https://hospiweb.novacdan.ro/login">Autentificare</a></li>
    <li class="nav-item" role="presentation"><a class="nav-link active" href="https://hospiweb.novacdan.ro/register">Înregistrare</a></li>
</ul>';} else {
        require_once 'db.php';

        $idHeader = $_SESSION['id'];
        $queryHEADER = "SELECT * FROM utilizatori WHERE id = '$idHeader'";
        
        $select_header_avatar = "SELECT * FROM avatars WHERE accountID='$idHeader'";
        $result_header_avatar = $connection->query($select_header_avatar);
            if($row_header_avatar = $result_header_avatar->fetch_assoc()) {
                $avatarNameHeader = $row_header_avatar['avatarName'];
            }
        
        $resultHEADER = $connection->query($queryHEADER);
        $rows_fetchHEADER = $resultHEADER->fetch_assoc();
        
        $sexHeader = $rows_fetchHEADER['sex'];
        $isMedicHeader = $rows_fetchHEADER['isMedic'];
        $utilizatorHeader = $rows_fetchHEADER['utilizator'];

    echo'
<ul class="profile-nav ml-auto">
    <div class="dropdown profile">
        <a class="dropdown-toggle" id="dropdownMenuLink" role="button" aria-expanded="true" aria-haspopup="true" href="#" data-toggle="dropdown">';
       if ($result_header_avatar->num_rows > 0) {
        echo'
        <img alt="profile-avatar" src="https://hospiweb.novacdan.ro/panel/profil/uploads/avatars/'.$avatarNameHeader.'">
        <span>'; if($isMedicHeader == 1) { echo 'Dr. &nbsp;'; } echo $utilizatorHeader; echo'</span>';
        } else {
        if ($sexHeader == 1 && $isMedicHeader != 0) { 
        echo'
        <img alt="profile-avatar" src="https://hospiweb.novacdan.ro/assets/img/mini-man-doctor.png">
        <span> Dr. &nbsp;' .$utilizatorHeader; echo'</span>';}
        else if ($sexHeader == 2 && $isMedicHeader != 0) { echo'
        <img alt="profile-avatar" src="https://hospiweb.novacdan.ro/assets/img/mini-women-doctor.png">
        <span> Dr. &nbsp;' .$utilizatorHeader; echo'</span>';} 
        else if ($sexHeader == 1 && $isMedicHeader == 0) { echo'
        <img alt="profile-avatar" src="https://hospiweb.novacdan.ro/assets/img/mini-man.png">
        <span>'.$utilizatorHeader; echo'</span>';}                        
        else if ($sexHeader == 2 && $isMedicHeader == 0) { echo'
        <img alt="profile-avatar" src="https://hospiweb.novacdan.ro/assets/img/mini-women.png">
        <span>' .$utilizatorHeader; echo'</span>';}
        else { echo'
        <img alt="profile-avatar" src="https://hospiweb.novacdan.ro/assets/img/mini-unisex.png">
        <span>' .$utilizatorHeader; echo'</span>';}
        }
         echo '
        </a>
    <div class="dropdown-menu dropdown-menu-right snow" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="https://hospiweb.novacdan.ro/panel/profil/eu">
            <i class="fa fa-user">&nbsp;
            </i>
            <span>Profilul meu</span>
        </a>
        <a class="dropdown-item" href="https://hospiweb.novacdan.ro/panel/pacienti">
            <i class="fa fa-users">&nbsp;
            </i>
            <span>Pacienti</span>
        </a> 
        <a class="dropdown-item" href="https://hospiweb.novacdan.ro/panel/doctori">
            <i class="fa fa-user-md">&nbsp;
            </i>
            <span>Doctori</span>
        </a>
        <a class="dropdown-item" href="https://hospiweb.novacdan.ro/panel/ticket/list">
            <i class="fa fa-ticket">&nbsp;
            </i>
            <span>Tichete</span>
        </a>                      
        <a class="dropdown-item" style="color:red" href="https://hospiweb.novacdan.ro/panel/transplanturi">
            <i class="fa fa-heart">&nbsp;
            </i>
            <span>Transplanturi</span>
        </a>  
        <div class="dropdown-divider"></div>
        <form action="https://hospiweb.novacdan.ro/includes/logout.inc.php" method="POST">
        <button class="btn dropdown-item" type="submit" name="logout"><i class="fa fa-unlock">&nbsp;</i>Deloghează-te</button>
        </form>
    </div>
</div>
</ul>';} ?>
