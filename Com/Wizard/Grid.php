<?php

class Com_Wizard_Grid extends Com_Object
{

    /**
     *
     * @access public
     * @var String
     */
    public $title = "";

    /**
     * @access private
     * @var Com_Database_Query
     */
    private $query = null;

    /**
     *
     * @access private
     * @var Array
     */
    private $lstAlias = array();

    /**
     *
     * @access private
     * @var Array
     */
    private $lstHiddenFields = array();

    /**
     *
     * @access private
     * @var type
     */
    private $lstFilters = array();

    /**
     *
     * @access private
     * @var Com_Wizard_ToolBar
     */
    private $toolBar = null;

    /**
     *
     * @access public
     * @var Integer
     */
    public $itemsPerPage = 12;

    /**
     *
     * @access private
     * @var Array
     */
    private $lstActions = array();

    /**
     *
     * @access private
     * @var String
     */
    private $idField = "";

    /**
     *
     * @access private
     * @var String
     */
    private $lanField = "";

    /**
     *
     * @access private
     * @var Array
     */
    private $lstCustomFields = array();

    /**
     * @access public
     */
    public function __construct()
    {
        $this->toolBar = new Com_Wizard_ToolBar();
    }

    /**
     * @access public
     */
    public function render()
    {
        $this->applyFilters();
        $message = "";
        Com_Database_Connection::getInstance()->execute($this->query);
        ?>
        <div class="formulario panel panel-success">
            <div class="title panel-heading">
                <h3 class="panel-title"><?PHP echo $this->title; ?></h3>

                <div class="panel-control">
                    <?PHP
                    $this->toolBar->render();
                    ?>
                </div>
            </div>
            <div class="panel-body">


                <form method="POST" name="gridForm" id="gridForm" class="form-horizontal">

                    <?PHP
                    /**
                     * Toolbar
                     */
                    $display = "none";
                    foreach ($this->lstFilters as $value) {
                        if ($value != "") {
                            $display = "block";
                        }
                    }
                    ?>
                    <div class="filters" style="display:<?PHP echo $display; ?>;">
                        <?PHP
                        foreach ($this->lstFilters as $index => $value) {
                            $control = new Com_Wizard_Form_Control();
                            $control->label = $this->getAlias($index);
                            $control->name = str_replace(".", "_", $index);
                            $control->default = $value;
                            $control->length = 50;
                            $control->render();
                        }
                        ?>
                        <div class="buttons input-group btn-group">
                            <input type="submit" value="Buscar" class="btn btn-primary btn-sm">
                        </div>
                        <div class="clearfix"></div>
                    </div

                            <div class="table-responsive">
                                <?PHP
                                $intTotalNumberRegistries = Com_Database_Connection::getInstance()->getNumberRegistries();
                                if ($intTotalNumberRegistries > 0) {
                                    ?>
                                    <?PHP
                                    if ($intTotalNumberRegistries > $this->itemsPerPage) {
                                        $intPages = intval($intTotalNumberRegistries / $this->itemsPerPage) + (($intTotalNumberRegistries % $this->itemsPerPage) > 0 ? 1 : 0);
                                        ?>
                                        <div class="paginations">
                                            <div class="componente">
                                                <div class="form-group form-group-sm">
                                                    <select class="form-control" name="gridPage" id="gridPage"
                                                            onchange="$('#gridForm').submit();">
                                                        <?PHP
                                                        for ($intCounter = 0; $intCounter < $intPages; $intCounter++) {
                                                            ?>
                                                            <option
                                                                value="<?PHP echo $intCounter; ?>" <?PHP echo($intCounter == get('gridPage') ? 'selected' : ''); ?>>
                                                                P&aacute;gina <?PHP echo ($intCounter + 1) . " de " . $intPages; ?></option>
                                                        <?PHP
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?PHP
                                    }
                                    ?>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr class="cabecera">
                                            <?PHP
                                            $intColumns = Com_Database_Connection::getInstance()->getNumberColumns();
                                            $objRow = Com_Database_Connection::getInstance()->getObject();
                                            foreach ($objRow as $strIndex => $strValue) {
                                                $strAlias = $this->getAlias($strIndex);
                                                if ($strAlias != $strIndex) {
                                                    ?>
                                                    <th>
                                                        <?PHP
                                                        echo $strAlias;
                                                        ?>
                                                    </th>
                                                <?PHP
                                                }
                                            }
                                            if (count($this->lstActions) > 0) {
                                                ?>
                                                <th width="13%">
                                                    Opc.
                                                </th>
                                            <?PHP
                                            }
                                            ?>
                                        </tr>
                                        </thead>
                                        <?PHP
                                        Com_Database_Connection::getInstance()->execute($this->query->limit((get('gridPage') * $this->itemsPerPage), $this->itemsPerPage));
                                        $intNumberRegistries = Com_Database_Connection::getInstance()->getNumberRegistries();
                                        for ($i = 0; $i < $intNumberRegistries; $i++) {
                                            $objRow = Com_Database_Connection::getInstance()->getObject();
                                            ?>
                                            <tr class="<?PHP echo(($i % 2 == 0) ? 'blanca' : 'gris'); ?>">
                                                <?PHP
                                                foreach ($objRow as $strIndex => $strValue) {
                                                    $strAlias = $this->getAlias($strIndex);
                                                    if ($strAlias != $strIndex) {
                                                        ?>
                                                        <td>
                                                            <?PHP
                                                            echo '&nbsp;&nbsp;' . $this->customizeField($strIndex, $objRow->$strIndex);
                                                            ?>
                                                        </td>
                                                    <?PHP
                                                    }
                                                }
                                                if (count($this->lstActions) > 0) {
                                                    ?>
                                                    <td align="center" valign="center">
                                                        <?PHP
                                                        $intId = $this->idField;
                                                        if ($this->lanField != "") {
                                                            $lanField = $this->lanField;
                                                            $this->getActions($objRow->$intId, $objRow->$lanField);
                                                        } else {
                                                            $this->getActions($objRow->$intId);
                                                        }
                                                        ?>
                                                    </td>
                                                <?PHP
                                                }
                                                ?>
                                            </tr>
                                        <?PHP
                                        }
                                        ?>
                                    </table>
                                <?PHP
                                } else {
                                    ?>
                                    <div class="message alert alert-danger" role="alert">
                                        No se encontraron registros
                                    </div>
                                <?PHP
                                }
                                ?>
                            </div>

                </form>
            </div>
        </div>
    <?PHP
    }

    /**
     *
     * @access private
     * @param Integer $id
     */
    private function getActions($id, $lan = "")
    {
        ?>
        <div class="btn-group btn-group-sm">
            <?PHP
            foreach ($this->lstActions as $lstIcon) {
                $lstIcon['href'] = str_replace("_ID_", $id, $lstIcon['href']);
                $lstIcon['action'] = str_replace("_ID_", $id, $lstIcon['action']);
                $lstIcon['href'] = str_replace("_LANGUAGE_", $lan, $lstIcon['href']);
                $lstIcon['action'] = str_replace("_LANGUAGE_", $lan, $lstIcon['action']);
                ?>
                <a <?PHP
                echo($lstIcon['href'] != "" ? 'href="' . $lstIcon['href'] . '"' : "");
                echo($lstIcon['action'] != "" ? 'onclick="' . $lstIcon['action'] . '"' : "");
                ?> title="<?PHP echo $lstIcon['label']; ?>" alt="<?PHP echo $lstIcon['label']; ?>"
                   class="btn btn-default"><span class="<?PHP echo $lstIcon['image']; ?>"></span></a>
            <?PHP
            }
            ?>
        </div>
    <?PHP
    }

    /**
     *
     * @access private
     * @param type $name
     * @return String
     */
    private function getAlias($name)
    {
        if (!(strpos($name, ".") === false)) {
            $aux = explode(".", $name);
            $aux = $aux[1];
            return (isset($this->lstAlias[$aux]) ? $this->lstAlias[$aux] : $aux);
        }
        return (isset($this->lstAlias[$name]) ? $this->lstAlias[$name] : $name);
    }

    /**
     *
     * @param Com_Database_Query $query
     */
    public function setQuery(Com_Database_Query $query)
    {
        $this->query = $query;
    }

    /**
     *
     * @access public
     * @param String $idField
     */
    public function setIdField($idField)
    {
        $this->idField = $idField;
    }

    /**
     *
     * @access public
     * @param String $idField
     */
    public function setLanField($lanField)
    {
        $this->lanField = $lanField;
    }

    /**
     *
     * @access public
     * @param type $lstAlias
     */
    public function setAlias($lstAlias)
    {
        $this->lstAlias = $lstAlias;
    }

    /**
     *
     * @access public
     * @param Array $lstFields
     */
    public function setHiddenFields($lstFields)
    {
        $this->lstHiddenFields = $lstFields;
    }

    /**
     *
     * @access public
     * @param Array $lstFilters
     */
    public function setFilters($lstFilters)
    {
        $this->lstFilters = $lstFilters;
    }

    /*
     * @access private
     */

    private function applyFilters()
    {
        if (!$this->query->hasConditions()) {
            $this->query->where("1=1");
        }
        foreach ($this->lstFilters as $index => $value) {
            if ($value != "") {
                $value = strtolower($value);
                $this->query->andWhere("LOWER({$index}) like '%{$value}%'");
            }
        }
    }

    /**
     *
     * @Access public
     * @param Com_Wizard_ToolBar $toolBar
     */
    public function setToolBar(Com_Wizard_ToolBar $toolBar)
    {
        $this->toolBar = $toolBar;
    }

    /**
     *
     * @access public
     * @param String $image
     * @param String $label
     * @param String $href
     * @param String $action
     */
    public function addAction($image, $label, $href = "", $action = "")
    {
        $this->lstActions[] = array(
            'image' => 'glyphicon glyphicon-' . $image
        , 'label' => $label
        , 'href' => $href
        , 'action' => $action
        );
    }

    /**
     *
     * @access public
     * @param String $field
     * @param Array $lstParameters
     */
    public function customField($field, $lstParameters)
    {
        $this->lstCustomFields[$field] = $lstParameters;
    }

    /**
     *
     * @access private
     * @param String $index
     * @param String $value
     * @return String
     */
    private function customizeField($index, $value)
    {
        if (isset($this->lstCustomFields[$index])) {
            $lstCustom = $this->lstCustomFields[$index];
            if (isset($lstCustom['value'])) {
                foreach ($lstCustom['value'] as $key => $newValue) {
                    if ($value == $key) {
                        return $newValue;
                    }
                }
            }
            if (isset($lstCustom['dateFormat'])) {
                $value = strtotime($value);
                $value = date($lstCustom['dateFormat'], $value);
            }
            if (isset($lstCustom['image'])) {
                $value = '<img src="' . Com_Helper_Url::getInstance()->getResources() . "/Uploads/" . $value . '" border="0" width="240px">';
            }
        }
        return $value;
    }

}
