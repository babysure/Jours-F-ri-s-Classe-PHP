<?php



namespace App\Services ;



class JoursFeries
{





  /**
  * retourne le prochain jour de l'an prévu après cette date (01-01)
  */
  public function calculeJourDeLan(\DateTime $date) {

    return  $this-> caluleDateFixe($date , "01-01" ) ;

  }


  /*
  * retourne le prochain lundi de paques à partir de la date passé en paramètre
  */
  public function calculeLundiPaques(\DateTime $date){

    $date =  new \DateTime( $date->format("Y-m-d") ) ;

    $annee =  (int) $date->format("Y") ;

    $dimanchePaques  = $this->calculeDimanchePaques( $annee ) ;



    if ( $dimanchePaques < $date ) {

      $date->modify("+1 year")  ;

      $annee =  (int) $date->format("Y") ;

      $dimanchePaques  = $this->calculeDimanchePaques( $annee ) ;

    }



    return $dimanchePaques->modify("+1 day") ;


  }




  /**
  * retourne la prochaine fête du travail prévu après cette date (01-05)
  */

  public function calculeFeteDuTravail(\DateTime $date){


    return  $this-> caluleDateFixe($date , "01-05" ) ;

  }



      /**
      * retourne la prochaine fête du travail prévu après cette date (08-05)
      */
  public function calculeVictoireAllies(\DateTime $date){


  return  $this-> caluleDateFixe($date , "08-05" ) ;

  }



  public function calculeAscension(\DateTime $date){



    $lundiPaques = $this->calculeLundiPaques($date) ;

    return $lundiPaques->modify("+38 day") ;

  }


  public function calculeLundiPentecote(\DateTime $date){


      $lundiPaques = $this->calculeLundiPaques($date) ;

      return $lundiPaques->modify("+49 day") ;

  }






  public function calculeFeteNationale(\DateTime $date){

    return  $this-> caluleDateFixe($date , "14-07"  ) ;

  }


  public function calculeAssomption(\DateTime $date){


    return  $this-> caluleDateFixe($date , "15-08") ;
  }

  public function calculeToussaint(\DateTime $date){


    return $this-> caluleDateFixe($date , "01-11") ;
  }

  public function calculeToussaint2(\DateTime $date){


      return $this-> caluleDateFixe($date , "02-11") ;

  }


  public function calculeArmistice(\DateTime $date){


  return $this-> caluleDateFixe($date , "11-11") ;

  }




  public function calculeNoel(\DateTime $date){


    return $this-> caluleDateFixe($date , "25-12") ;

  }

  /*
  * dateFixe  : "jour-mois"
  */
  private function caluleDateFixe(\DateTime $date , string $dateFixe){



        $date =  new \DateTime( $date->format("Y-m-d") ) ;



        while(  $date->format("d-m") != $dateFixe  ){

          $date->modify("+1 day") ;

        }


        return $date ;


  }


  /*
  * renvoie la date du dimanche de paques de l'année de la date passé en paramètre
  */

  private function calculeDimanchePaques(int $Year){

  
    $a= intval( $Year/100 ) ;
    $b= $Year % 100 ;
    $c=  intval( (3*($a+25))  /4 ) ;
    $d=(3*($a+25))%4 ;
    $e= intval(  (8*($a+11))  /25 ) ;
    $f= intval(  (5*$a+$b)%19 ) ;
    $g=  (19*$f+$c-$e)%30 ;
    $h= intval(   ($f+11*$g) /319 ) ;
    $j= intval( (60*(5-$d)+$b)  /4 ) ;
    $k=(60*(5-$d)+$b)%4 ;
    $m=(2*$j-$k-$g+$h)%7 ;
    $n= intval( ($g-$h+$m+114) /31 ) ;
    $p=($g-$h+$m+114)%31 ;
    $jour=$p+1 ;
    $mois=$n ;

    return new \DateTime("$Year-$mois-$jour") ;


  }



}
