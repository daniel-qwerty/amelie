<?php

class Com_Wizard_Report extends Com_Object {

    /**
     *
     * @access public
     * @var String
     */
    public $title = "";

    /**
     *
     * @access private
     * @var String 
     */
    private $fileXls = "";

    /**
     *
     * @access private
     * @var String 
     */
    private $fileDoc = "";
    private $toolBar;

    /**
     * 
     * @static
     * @access public
     * @return Com_Wizard_Report 
     */
    public static function getInstance() {
        return self::_getInstance(__CLASS__);
    }

    public function open() {

        $this->fileXls = "report.xls";
        $this->fileDoc = "report.doc";

        $this->toolBar = new Com_Wizard_ToolBar();
        $this->toolBar->add("align-justify", "Exportar a Word", null, "window.open('" . Com_Helper_Url::getInstance()->urlBase . "/Temp/" . $this->fileDoc . "');");
        $this->toolBar->add("th", "Exportar a Excel", null, "window.open('" . Com_Helper_Url::getInstance()->urlBase . "/Temp/" . $this->fileXls . "');");
        $this->toolBar->add("refresh", "Actualizar", null, "window.location.reload();");
        $this->toolBar->add("print", "Imprimir", null, "printReport('" . Com_Helper_Url::getInstance()->getStyle() . "');");
        $this->toolBar->add("log-out", "Volver", Com_Helper_Url::getInstance()->urlBase . '/Admin/Contact');
        ?>
        <div id="barraReporte">
            <?PHP
            $this->toolBar->render();
            ?>
        </div>
        <div id="cuerpoReporte">
            <div class="titulo">
                <?PHP
                echo $this->title;
                ?>
            </div>
            <div class="datosReporte">
                <?PHP
                echo "Fecha:" . date("d/m/Y");
                ?>
                <br>
                <?PHP
                echo "Hora:" . date("H:i:s");
                ?>
            </div>
            <?PHP
            ob_start();
            ?>
            <div class="cuerpo">
                <?PHP
            }

            public function close() {
                ?>
            </div>
            <div class="pieReporte">
                Sinapsis Digital
            </div>
            <?PHP
            $buffer = ob_get_contents();
            ob_end_flush();

            $file = fopen(Com_Helper_Url::getInstance()->physicalDirectory . "/Temp/" . $this->fileXls, "w+");
            fwrite($file, $buffer);
            fclose($file);

            $file = fopen(Com_Helper_Url::getInstance()->physicalDirectory . "/Temp/" . $this->fileDoc, "w+");
            fwrite($file, $buffer);
            fclose($file);
            ?>
        </div>
        <?PHP
    }

}
