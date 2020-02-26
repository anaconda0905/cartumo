import * as utils from './scripts/builder/helpers';
import {initDragDrop} from './scripts/builder/cmb';
import * as Defaults from './scripts/builder/defaults';
import {initComponents} from './scripts/builder/components';
import {initFunctions} from './scripts/builder/functions';

// let viewWidgetSections = [];

class CmbBuilder {

    constructor() {

        this.common = {};
        this.viewWidgetSections = [];
        this.utils = utils;
        this.defaults = Defaults;
    }
};

let cmbBuilder = new CmbBuilder();

initDragDrop(cmbBuilder);

initComponents(cmbBuilder);

initFunctions(cmbBuilder);
