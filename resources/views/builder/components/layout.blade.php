<div class="dropdown-content" style="display: block;">
    <div class="tve-control" data-view="MarginAndPadding"><div class="layout-title-holder">
            <div class="control-grid">
		<span class="title">
			Margins &amp; Padding		</span>
                <span class="sub-title">
			(Click + Drag)		</span>
                <div style="display:none;">
                    <select class="tve-select um change" data-fn="umChange" style="display:none;">
                        <option value="px">px</option>
                        <option value="%">%</option>
                        <option value="em">em</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="wrapper-trapez">
            <div class="trapez mare sus handle reverse top cursor-resize-y" data-dir="top" data-style="margin"></div>
            <input class="tve-input top change input keyup" data-fn-keyup="keyup" data-side="top" data-fn="change" data-fn-input="change" value="0" data-style="margin" tabindex="900">
            <div class="trapez mare jos handle bottom cursor-resize-y" data-dir="bottom" data-style="margin"></div>
            <input class="tve-input bottom change input keyup" data-fn-keyup="keyup" data-side="bottom" data-fn="change" data-fn-input="change" value="0" data-style="margin" tabindex="902">
            <div class="trapez mare stanga handle reverse left cursor-resize-y" data-dir="left" data-style="margin"></div>
            <input class="tve-input left change input keyup" data-fn-keyup="keyup" data-side="left" data-fn="change" data-fn-input="change" value="0" data-style="margin" tabindex="903">
            <div class="trapez mare dreapta handle right cursor-resize-y" data-dir="right" data-style="margin"></div>
            <input class="tve-input right change input keyup" data-fn-keyup="keyup" data-side="right" data-fn="change" data-fn-input="change" value="0" data-style="margin" tabindex="901">
            <div class="trapez mic sus handle top cursor-resize-y p-value" data-dir="top" data-style="padding"></div>
            <input class="tve-input top change input keyup p-value" data-fn-keyup="keyup" data-side="top" data-fn="change" data-fn-input="change" value="0" data-style="padding" tabindex="904">
            <div class="trapez mic jos handle reverse bottom cursor-resize-y p-value" data-dir="bottom" data-style="padding"></div>
            <input class="tve-input bottom change input keyup p-value" data-fn-keyup="keyup" data-side="bottom" data-fn="change" data-fn-input="change" value="0" data-style="padding" tabindex="906">
            <div class="trapez mic stanga handle left cursor-resize-y p-value" data-dir="left" data-style="padding"></div>
            <input class="tve-input left change input keyup p-value" data-fn-keyup="keyup" data-side="left" data-fn="change" data-fn-input="change" value="0" data-style="padding" tabindex="907">
            <div class="trapez mic dreapta handle reverse right cursor-resize-y p-value" data-dir="right" data-style="padding"></div>
            <input class="tve-input right change input keyup p-value" data-fn-keyup="keyup" data-side="right" data-fn="change" data-fn-input="change" value="0" data-style="padding" tabindex="905">
            <div class="click link" data-fn="linkInput">
                <svg class="tcb-icon tcb-icon-unlock-light"><use xlink:href="#icon-unlock-light"></use></svg>	</div>
        </div>

        <div class="row">
            <div class="col-xs-12">
		<span class="error" style="display: none;">
			The value entered is not valid. Please try again.		</span>
            </div>
        </div>
    </div>

    <hr>
    <div class="mb-10">
        <div class="tve-control full-width-hidden no-space" data-prop="width" data-label="Width"><div class="pb-6 layout-width">
                <label>Width</label>
                <div class="control-grid no-space">
                    <div class="tve-control tabs mr-10 border btn-group-light"><div class="full-width button-group-holder control-grid no-space tve-group-">

                            <div class="items-3 input tve-btn-group">

                                <div class="tve-btn click  btn-text" data-fn="_click" data-value="width">
                                    Fixed

                                </div>

                                <div class="tve-btn click  btn-text" data-fn="_click" data-value="min-width">
                                    Min

                                </div>

                                <div class="tve-btn click  btn-text active" data-fn="_click" data-value="max-width">
                                    Max

                                </div>

                            </div>
                        </div>
                        <div class="control-grid full-width">
                            <div style="display: none" class="fill tcb-text-right control-summary padding-top-5 w-100"></div>
                            <div style="display: none" class="info-text"></div>
                        </div></div>
                    <div class="inputs">
                        <div class="slider-input has-clear" data-tab="width" style="display: none;">
                            <span class="input-um click" tabindex="2">px</span>
                            <input type="text" class="tve-input input change width-input has-um cursor-resize-y" data-fn="change_value" data-fn-input="on_input" data-uom="px" data-prop="width">
                            <div class="um-wrapper">
                                <span class="tve-input-um mousedown active" data-fn="change_uom" data-value="px" data-prop="width">px</span>
                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="%" data-prop="width">%</span>
                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="vw" data-prop="width">vw</span>
                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="vh" data-prop="width">vh</span>
                            </div>
                            <a href="javascript:void(0)" class="input-clear click" data-fn="clear_value" data-width="fluid" data-tooltip="Change Size to Auto" data-prop="width"><svg class="tcb-icon tcb-icon-times-light"><use xlink:href="#icon-times-light"></use></svg></a>			</div>
                        <div class="slider-input has-clear" data-tab="min-width" style="display: none;">
                            <span class="input-um click" tabindex="2">px</span>
                            <input type="text" class="tve-input input change width-input has-um cursor-resize-y" data-fn="change_value" data-fn-input="on_input" data-uom="px" data-prop="min-width">
                            <div class="um-wrapper">
                                <span class="tve-input-um mousedown active" data-fn="change_uom" data-value="px" data-prop="min-width">px</span>
                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="%" data-prop="min-width">%</span>
                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="vw" data-prop="min-width">vw</span>
                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="vh" data-prop="min-width">vh</span>
                            </div>
                            <a href="javascript:void(0)" class="input-clear click" data-fn="clear_value" data-width="fluid" data-tooltip="Change Size to Auto" data-prop="min-width"><svg class="tcb-icon tcb-icon-times-light"><use xlink:href="#icon-times-light"></use></svg></a>			</div>
                        <div class="slider-input has-clear" data-tab="max-width" style="display: block;">
                            <span class="input-um click" tabindex="2">px</span>
                            <input type="text" class="tve-input input change width-input has-um cursor-resize-y" data-fn="change_value" data-fn-input="on_input" data-uom="px" data-prop="max-width">
                            <div class="um-wrapper">
                                <span class="tve-input-um mousedown active" data-fn="change_uom" data-value="px" data-prop="max-width">px</span>
                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="%" data-prop="max-width">%</span>
                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="vw" data-prop="max-width">vw</span>
                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="vh" data-prop="max-width">vh</span>
                            </div>
                            <a href="javascript:void(0)" class="input-clear click" data-fn="clear_value" data-width="fluid" data-tooltip="Change Size to Auto" data-prop="max-width"><svg class="tcb-icon tcb-icon-times-light"><use xlink:href="#icon-times-light"></use></svg></a>			</div>
                    </div>
                </div>
            </div></div>
        <div class="tve-control" data-prop="height" data-label="Height"><div class="pb-6 layout-width">
                <label>Height</label>
                <div class="control-grid no-space">
                    <div class="tve-control tabs mr-10 border btn-group-light"><div class="full-width button-group-holder control-grid no-space tve-group-">

                            <div class="items-3 input tve-btn-group">

                                <div class="tve-btn click  btn-text" data-fn="_click" data-value="height">
                                    Fixed

                                </div>

                                <div class="tve-btn click  btn-text active" data-fn="_click" data-value="min-height">
                                    Min

                                </div>

                                <div class="tve-btn click  btn-text" data-fn="_click" data-value="max-height">
                                    Max

                                </div>

                            </div>
                        </div>
                        <div class="control-grid full-width">
                            <div style="display: none" class="fill tcb-text-right control-summary padding-top-5 w-100"></div>
                            <div style="display: none" class="info-text"></div>
                        </div></div>
                    <div class="inputs">
                        <div class="slider-input has-clear" data-tab="height" style="display: none;">
                            <span class="input-um click" tabindex="2">px</span>
                            <input type="text" class="tve-input input change width-input has-um cursor-resize-y" data-fn="change_value" data-fn-input="on_input" data-uom="px" data-prop="height">
                            <div class="um-wrapper">
                                <span class="tve-input-um mousedown active" data-fn="change_uom" data-value="px" data-prop="height">px</span>


                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="vh" data-prop="height">vh</span>
                            </div>
                            <a href="javascript:void(0)" class="input-clear click" data-fn="clear_value" data-width="fluid" data-tooltip="Change Size to Auto" data-prop="height"><svg class="tcb-icon tcb-icon-times-light"><use xlink:href="#icon-times-light"></use></svg></a>			</div>
                        <div class="slider-input has-clear" data-tab="min-height" style="display: block;">
                            <span class="input-um click" tabindex="2">px</span>
                            <input type="text" class="tve-input input change width-input has-um cursor-resize-y" data-fn="change_value" data-fn-input="on_input" data-uom="px" data-prop="min-height">
                            <div class="um-wrapper">
                                <span class="tve-input-um mousedown active" data-fn="change_uom" data-value="px" data-prop="min-height">px</span>


                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="vh" data-prop="min-height">vh</span>
                            </div>
                            <a href="javascript:void(0)" class="input-clear click" data-fn="clear_value" data-width="fluid" data-tooltip="Change Size to Auto" data-prop="min-height"><svg class="tcb-icon tcb-icon-times-light"><use xlink:href="#icon-times-light"></use></svg></a>			</div>
                        <div class="slider-input has-clear" data-tab="max-height" style="display: none;">
                            <span class="input-um click" tabindex="2">px</span>
                            <input type="text" class="tve-input input change width-input has-um cursor-resize-y" data-fn="change_value" data-fn-input="on_input" data-uom="px" data-prop="max-height">
                            <div class="um-wrapper">
                                <span class="tve-input-um mousedown active" data-fn="change_uom" data-value="px" data-prop="max-height">px</span>


                                <span class="tve-input-um mousedown" data-fn="change_uom" data-value="vh" data-prop="max-height">vh</span>
                            </div>
                            <a href="javascript:void(0)" class="input-clear click" data-fn="clear_value" data-width="fluid" data-tooltip="Change Size to Auto" data-prop="max-height"><svg class="tcb-icon tcb-icon-times-light"><use xlink:href="#icon-times-light"></use></svg></a>			</div>
                    </div>
                </div>
            </div></div>
    </div>

    <div class="full-width-hidden mb-10">
        <div class="tve-control tve-alignment-control no-space" data-view="Alignment"><div class="button-group-holder control-grid no-space tve-group-Alignment">
                <span class="button-group-name label grey-text">Alignment</span>
                <div class="items-4 input tve-btn-group">

                    <div class="tve-btn click default active" data-tooltip="No Alignment" data-fn="_click" data-value="none">

                        <svg class="tcb-icon tcb-icon-none">
                            <use xlink:href="#icon-none"></use>
                        </svg>
                    </div>

                    <div class="tve-btn click" data-tooltip="Align Left" data-fn="_click" data-value="left">

                        <svg class="tcb-icon tcb-icon-a_left">
                            <use xlink:href="#icon-a_left"></use>
                        </svg>
                    </div>

                    <div class="tve-btn click" data-tooltip="Align Center" data-fn="_click" data-value="center">

                        <svg class="tcb-icon tcb-icon-a_center">
                            <use xlink:href="#icon-a_center"></use>
                        </svg>
                    </div>

                    <div class="tve-btn click" data-tooltip="Align Right" data-fn="_click" data-value="right">

                        <svg class="tcb-icon tcb-icon-a_right">
                            <use xlink:href="#icon-a_right"></use>
                        </svg>
                    </div>

                </div>
            </div>
            <div class="control-grid full-width">
                <div style="display: none" class="fill tcb-text-right control-summary padding-top-5 w-100"></div>
                <div style="display: none" class="info-text"></div>
            </div></div>
        <div class="tve-control no-space mt-10" data-view="Display"><div class="button-group-holder control-grid no-space tve-group-Display">
                <span class="button-group-name label grey-text">Display</span>
                <div class="items-2 input tve-btn-group">

                    <div class="tve-btn click  btn-text" data-fn="_click" data-value="inline-block">
                        Inline

                    </div>

                    <div class="tve-btn click  btn-text active" data-fn="_click" data-value="block">
                        Block

                    </div>

                </div>
            </div>
            <div class="control-grid full-width">
                <div style="display: none" class="fill tcb-text-right control-summary padding-top-5 w-100"></div>
                <div style="display: none" class="info-text"></div>
            </div></div>
    </div>

    <div class="tve-advanced-controls extend-grey">
        <div class="dropdown-header" data-prop="advanced">
				<span>
					Advanced				</span>
        </div>

        <div class="dropdown-content pt-0" style="display: none;">
            <div class="layout-adv fluid-input no-space">
                <div class="tve-control float full-width-hidden" data-view="Float"><div class="button-group-holder control-grid no-space tve-group-Float">
                        <span class="button-group-name label grey-text">Float</span>
                        <div class="items-2 input tve-btn-group">

                            <div class="tve-btn click active" data-fn="_click" data-value="both">

                                <svg class="tcb-icon tcb-icon-none">
                                    <use xlink:href="#icon-none"></use>
                                </svg>
                            </div>

                            <div class="tve-btn click default" data-fn="_click" data-value="none">

                                <svg class="tcb-icon tcb-icon-check">
                                    <use xlink:href="#icon-check"></use>
                                </svg>
                            </div>

                        </div>
                    </div>
                    <div class="control-grid full-width">
                        <div style="display: none" class="fill tcb-text-right control-summary padding-top-5 w-100"></div>
                        <div style="display: none" class="info-text"></div>
                    </div></div>
                <div class="tve-control z-index" data-view="zIndex"><div class="input-control control-grid Z-index-input">

	<span class="input-label label">
		Z-index
	</span>

                        <div class="input tcb-relative">
                            <span class="input-um "></span>
                            <div data-dir="top" class="mid handle reverse  cursor-resize-y">
                                <div class="up click" data-fn="up"></div>
                                <div class="down click" data-fn="down"></div>
                            </div>
                            <input class="tve-input change input  " value="" data-fn-change="validate_and_change" data-fn-input="input" type="text">
                        </div>
                    </div></div>
            </div>
            <div class="info-text orange">Z-Index only works for elements with "Relative" or "Absolute" positioning</div>
            <div class="tve-control full-width no-space mt-10 pt-10 layout-position-toggle" data-view="Position"><div class="button-group-holder control-grid no-space tve-group-Position">
                    <span class="button-group-name label grey-text">Position</span>
                    <div class="items-3 input tve-btn-group">

                        <div class="tve-btn click default btn-text active" data-fn="_click" data-value="auto">
                            Auto

                        </div>

                        <div class="tve-btn click  btn-text" data-fn="_click" data-value="relative">
                            Relative

                        </div>

                        <div class="tve-btn click  btn-text" data-fn="_click" data-value="absolute">
                            Absolute

                        </div>

                    </div>
                </div>
                <div class="control-grid full-width">
                    <div style="display: none" class="fill tcb-text-right control-summary padding-top-5 w-100"></div>
                    <div style="display: none" class="info-text">Auto position cannot be used when floating is enabled</div>
                </div>
                <div class="layout-position">
                    <div class="position-auto" data-tab="auto" style="display: block;"></div>
                    <div class="position-relative tve-control" data-tab="relative" style="display: none;"><div class="horizontal ctrl no-space input-small" data-style="left" data-label="Horizontal"><div class="input-control control-grid Horizontal-input">

	<span class="input-label label">
		Horizontal
	</span>

                                <div class="input tcb-relative">
                                    <span class="input-um ">px</span>
                                    <div data-dir="top" class="mid handle reverse  cursor-resize-y">
                                        <div class="up click" data-fn="up"></div>
                                        <div class="down click" data-fn="down"></div>
                                    </div>
                                    <input class="tve-input change input  has-um" value="" data-fn-change="validate_and_change" data-fn-input="input" type="text" data-style="left">
                                </div>
                            </div></div>
                        <div class="vertical ctrl no-space input-small" data-style="top" data-label="Vertical"><div class="input-control control-grid Vertical-input">

	<span class="input-label label">
		Vertical
	</span>

                                <div class="input tcb-relative">
                                    <span class="input-um ">px</span>
                                    <div data-dir="top" class="mid handle reverse  cursor-resize-y">
                                        <div class="up click" data-fn="up"></div>
                                        <div class="down click" data-fn="down"></div>
                                    </div>
                                    <input class="tve-input change input  has-um" value="" data-fn-change="validate_and_change" data-fn-input="input" type="text" data-style="top">
                                </div>
                            </div></div></div>
                    <div class="position-absolute tve-control" data-tab="absolute" style="display: none;">
                        <div class="button-group-holder">
                            <div class="tve-btn-group">
			<span class="position click tve-btn" data-fn="positionChange" data-value="top|left"><svg class="tcb-icon tcb-icon-pos_top_left">
	<use xlink:href="#icon-pos_top_left"></use>
</svg></span>
                                <span class="position click tve-btn" data-fn="positionChange" data-value="top|right"><svg class="tcb-icon tcb-icon-pos_top_right">
	<use xlink:href="#icon-pos_top_right"></use>
</svg></span>
                                <span class="position click tve-btn" data-fn="positionChange" data-value="bottom|right"><svg class="tcb-icon tcb-icon-pos_bot_right">
	<use xlink:href="#icon-pos_bot_right"></use>
</svg></span>
                                <span class="position click tve-btn" data-fn="positionChange" data-value="bottom|left"><svg class="tcb-icon tcb-icon-pos_bot_left">
	<use xlink:href="#icon-pos_bot_left"></use>
</svg></span>
                            </div>
                        </div>

                        <div class="toggle-position" style="display: none;">
                            <div class="vertical">
                                <div class="tve-control input-small"><div class="input-control control-grid Top-input">

	<span class="input-label label">
		Top
	</span>

                                        <div class="input tcb-relative">
                                            <span class="input-um ">PX</span>
                                            <div data-dir="top" class="mid handle reverse  cursor-resize-y">
                                                <div class="up click" data-fn="up"></div>
                                                <div class="down click" data-fn="down"></div>
                                            </div>
                                            <input class="tve-input change input  has-um" value="" data-fn-change="validate_and_change" data-fn-input="input" type="text">
                                        </div>
                                    </div></div>
                            </div>
                            <div class="horizontal pl-5">
                                <div class="tve-control input-small"><div class="input-control control-grid Left-input">

	<span class="input-label label">
		Left
	</span>

                                        <div class="input tcb-relative">
                                            <span class="input-um ">PX</span>
                                            <div data-dir="top" class="mid handle reverse  cursor-resize-y">
                                                <div class="up click" data-fn="up"></div>
                                                <div class="down click" data-fn="down"></div>
                                            </div>
                                            <input class="tve-input change input  has-um" value="" data-fn-change="validate_and_change" data-fn-input="input" type="text">
                                        </div>
                                    </div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>