<?php

class Public_Model_Generic extends Com_Module_Model {

    /**
     *
     * @return Public_Model_Generic 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public static function getList($lanId, $pattern) {
        $page = new Com_Database_Entity_Language();
        $query = "select PagId as id ,PagName as title ,PagUrl as url ,PagDescription as resume,PagImage as image,'page' as type,'' as date
                    from Page where PagLanId= {$lanId} and (PagName like '%{$pattern}%' or PagDescription like '%{$pattern}%' or PagContent like '%{$pattern}%')
                    UNION
                    select NotId as id,NotTitle,NotUrl,NotResume,NotImage,'blog',DATE_FORMAT(NotDate,'%d/%m/%Y')  
                    from Notes where NotLanId= {$lanId} and (NotTitle like '%{$pattern}%' or NotResume like '%{$pattern}%' or NotContent like '%{$pattern}%')
                    UNION
                    select NewId as id,NewTitle,NewUrl,NewDescription,NewImage,'new',DATE_FORMAT(NewDate,'%d/%m/%Y')  
                    from News where NewLanId= {$lanId} and (NewTitle like '%{$pattern}%' or NewDescription like '%{$pattern}%' or NewContent like '%{$pattern}%')"
                    . "UNION
                    select GalId as id,GalName,GalId,GalDescription,GalImage,'galleries',DATE_FORMAT(GalDate,'%d/%m/%Y')  
                    from Galleries where GalLanId= {$lanId} and (GalName like '%{$pattern}%' or GalDescription like '%{$pattern}%')"
                . " ";
                    
        //print_r($query);
        //exit();
        return $page->getAll($query);
    }

}
