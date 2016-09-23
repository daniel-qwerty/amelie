<?php

class Com_Wizard_Form extends Com_Object {

    /**
     *
     * @access public
     * @var String
     */
    public $title;

    /**
     *
     * @access public
     * @var String
     */
    public $action = "";

    /**
     *
     * @access private
     * @var Array 
     */
    private $lstControls = array();

    /**
     * @access private
     * @var type 
     */
    private $toolBar;
    private $showToolBar = false;
    private $cssClasses = array();
    private $tabs = array();
    private $showTabs = false;

    public function __construct() {
        $this->toolBar = new Com_Wizard_ToolBar();
    }

    /**
     *
     * @access public
     * @param Com_Wizard_Form_Control $control 
     */
    public function add(Com_Wizard_Form_Control $control) {
        $this->lstControls [] = $control;
    }

    public function addAction($image, $label, $href = null, $javascript = null) {
        $this->toolBar->add($image, $label, $href, $javascript);
        $this->showToolBar = true;
    }

    public function addCssClass($class) {
        $this->cssClasses[] = $class;
    }

    public function addTab($label, $href, $active = false) {
        array_push($this->tabs, array("label" => $label, "href" => $href, "active" => $active));
        $this->showTabs = true;
    }

    /**
     * @access public
     */
    public function render() {
        $intId = date("YmdHis");
        ?>
        <div class="panel panel-info <?PHP echo implode(" ", $this->cssClasses); ?>">
            <div class="panel-heading">
                <h3 class="panel-title"><?PHP echo $this->title; ?></h3>
                <div class="panel-control">
                    <?PHP
                    $this->toolBar->render();
                    ?>
                </div>
            </div>
            <div class="panel-body">
                <br/>
                <?PHP
                if ($this->showTabs) {
                    ?>
                    <ul class="nav nav-tabs">
                        <?PHP
                        foreach ($this->tabs as $tab) {
                            ?>
                            <li role="presentation" class="<?PHP echo ($tab['active'] ? 'active' : ''); ?>"><a href="<?PHP echo $tab['href']; ?>"><?PHP echo $tab['label']; ?></a></li>
                            <?PHP
                        }
                        ?>
                    </ul>
                    <br/>
                    <?PHP
                }

                ?>
                <form method="POST" actions="<?PHP echo $this->action; ?>" id="F<?PHP echo $intId; ?>" enctype="multipart/form-data" class="form-horizontal">
                    <fieldset>
                        <?PHP
                        foreach ($this->lstControls as $objControl) {
                            $objControl->render();
                        }
                        ?>
                        <div class="input-group btn-group" <?PHP echo ($this->showToolBar ? 'style="display:none;"' : ''); ?>>
                            <input type="submit" class="btn btn-primary btn-sm"  id="saveForm" value="Guardar">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <?PHP
    }

}
