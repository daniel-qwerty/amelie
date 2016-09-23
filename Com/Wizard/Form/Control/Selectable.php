<?PHP

class Com_Wizard_Form_Control_Selectable extends Com_Wizard_Form_Control {

    public $url;
    public $addUrl;
    public $removeUrl;
    public $fields;
    public $idField;

    public function renderControl() {
        ?>
        <input type="hidden" class="form-control selectable" 
               id="<?PHP echo $this->name; ?>Config" 
               rel="<?PHP echo $this->name; ?>" 
               addUrl="<?PHP echo $this->addUrl; ?>"
               removeUrl="<?PHP echo $this->removeUrl; ?>"
               url="<?PHP echo $this->url; ?>">

        <div class="btn-group btn-group-sm">
            <a class="btn btn-default" id="<?PHP echo $this->name; ?>Select">
                <span class="glyphicon glyphicon-th-list"></span>
                <span>Seleccionar</span>
            </a>
            <a class="btn btn-default" id="<?PHP echo $this->name; ?>Delete">
                <span class="glyphicon glyphicon-remove-circle"></span>
                <span>Eliminar</span>
            </a>
        </div>
        <table class="table table-striped table-hover" id="<?PHP echo $this->name; ?>Table">
            <thead>
                <tr class="cabecera">
                    <th width="20%"></th>
                    <?PHP
                    foreach ($this->fields as $index => $alias) {
                        if ($index != $this->idField) {
                            ?>
                            <th>
                                <?PHP echo $alias; ?>
                            </th>
                            <?PHP
                        }
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?PHP
                foreach ($this->default as $item) {
                    ?>
                    <tr>
                        <?PHP
                        foreach ($item as $index => $value) {
                            if ($index == $this->idField) {
                                ?>
                                <td>
                                    <input type="checkbox" name="<?PHP echo $this->name; ?>Check[]" value="<?PHP echo $value; ?>">
                                    <input type="hidden" name="<?PHP echo $this->name; ?>[]" value="<?PHP echo $value; ?>">
                                </td>
                                <?PHP
                            }
                        }
                        foreach ($item as $index => $value) {
                            if (($index != $this->idField) && ($this->inFields($index))) {
                                ?>
                                <td><?PHP echo $value; ?></td>
                                <?PHP
                            }
                        }
                        ?>
                    </tr>
                    <?PHP
                }
                ?>
            </tbody>
        </table>
        <?PHP
    }

    private function inFields($field) {
        foreach ($this->fields as $index => $alias) {
            if ($index == $field) {
                return true;
            }
        }
        return false;
    }

}
