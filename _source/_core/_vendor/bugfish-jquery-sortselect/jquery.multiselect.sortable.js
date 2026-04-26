/*
 Hasan Yüksektepe <hayatikodla.net>
 Further Developed by Bugfish <www.bugfish.eu>
 Version : 1.0.0
	bugfish-jquery-sortselect
		__________ ____ ___  ___________________.___  _________ ___ ___  
		\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
		 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
		 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
		 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
				\/                 \/     \/                \/       \/  	
							www.bugfish.eu
							
	    Bugfish Fast PHP Page Framework
		Copyright (C) 2024 Jan Maurice Dahlmanns [Bugfish]

		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program.  If not, see <https://www.gnu.org/licenses/>.
	*/
(function($){

    $.fn.bugfish_sortselect = function(options){

        var defaults = {
            selectable:{
                title   :'<b>Inaktiv</b>',
                sortable:true
            },
            selection :{
                title   :'<b>Aktiv</b>',
                sortable:true
            },
            reverse   :true,
            rid   	  :10
        };

        var me = this;

        var select_name = me.attr('name');
        var classes     = $(me).attr('class');

        var select = document.createElement('select');
        select.setAttribute('multiple', '');
        select.setAttribute('name', select_name+'[]');
        select.setAttribute('class', classes);
        select.setAttribute('style', "display:none");

        var select_data = $(me).data();
        $.each(select_data, function(i, e){
            select.setAttribute('data-'+i, e);
        })

        var settings = $.extend(true, defaults, options);
        var parent   = this.parent();

        $(me).attr('class', '');
        this.addClass('multiselect_sortable_hide');
        $(me).prop('disabled', true);

        var selectable = '';
        var selection  = '';
        $.each($(' option', me), function(i, e){

            var name              = $(e).html();
            var value             = $(e).attr('value');
            var selected          = $(e).attr('selected');
            var disabled          = $(e).attr('disabled');
            var data              = $(e).data();
            var element_data_list = '';
            var create_id         = 'id'+Math.floor(Math.random()*999);

            $(e).attr('data-unit_id', create_id)

            $.each(data, function(i, e){
                element_data_list += 'data-'+i+'="'+e+'"';
            })

            if(selected!=undefined){
                selection += '<li class="select_li_'+defaults.rid+' '+(disabled?'disabled':'')+'" data-uniq_id="'+create_id+'" data-name="'+name+'" data-value="'+value+'" '+element_data_list+'>'+name+'</li>';
            }
            else{
                selectable += '<li class="select_li_'+defaults.rid+' '+(disabled?'disabled':'')+'" data-uniq_id="'+create_id+'" data-name="'+name+'" data-value="'+value+'" '+element_data_list+'>'+name+'</li>';
            }
        });

        if(defaults.reverse==false){
            var content = `
            <div class="multiselect_sortable_content multiselect_sortable_content_`+defaults.rid+`">
                <div class="multiselect_sortable_content_selection multiselect_sortable_content_selection_`+defaults.rid+`">
                    <div class="selection_title_`+defaults.rid+`">${settings.selection.title}</div>
                    <ul class="selection_content selection_content_`+defaults.rid+` sortable sortable_`+defaults.rid+`">
                        ${selection}
                    </ul>
                </div>
                <div class="multiselect_sortable_content_selectable_`+defaults.rid+`">
                    <div class="selectable_title_`+defaults.rid+`">${settings.selectable.title}</div>
                    <ul class="selectable_content_`+defaults.rid+`">
                        ${selectable}
                    </ul>
                </div>
            </div>
        `;
        }
        else{
            var content = `
            <div class="multiselect_sortable_content multiselect_sortable_content_`+defaults.rid+`">
                <div class="multiselect_sortable_content_selectable multiselect_sortable_content_selectable_`+defaults.rid+`">
                    <div class="selectable_title_`+defaults.rid+`">${settings.selectable.title}</div>
                    <ul class="selectable_content selectable_content_`+defaults.rid+`">
                        ${selectable}
                    </ul>
                </div>
                <div class="multiselect_sortable_content_selection multiselect_sortable_content_selection_`+defaults.rid+`">
                    <div class="selection_title_`+defaults.rid+`">${settings.selection.title}</div>
                    <ul class="selection_content selection_content_`+defaults.rid+` sortable sortable_`+defaults.rid+`">
                        ${selection}
                    </ul>
                </div>
            </div>
        `;
        }


        $(parent).append(content)

        $(document).on('click', '.selectable_content_'+defaults.rid+' .select_li_'+defaults.rid+':not(.disabled)', function(){
            const html = $(this)[0].outerHTML;
            $('.selection_content_'+defaults.rid+'').append(html);
            $(this).remove();
            sortable_selectbox();
        });

        $(document).on('click', '.selection_content_'+defaults.rid+' .select_li_'+defaults.rid+':not(.disabled)', function(){
            var html = $(this)[0].outerHTML;
            $('.selectable_content_'+defaults.rid+'').append(html);
            $(this).remove();
            sortable_selectbox();
        });

        if(defaults.selectable.sortable==true){
            $(".sortable_"+defaults.rid+"").sortable({
                connectWith:"ul",
                axis       :'y',
                start      :function(e){
                    sortable_selectbox();
                },
                change     :function(e){
                    sortable_selectbox();
                },
                update     :function(e){
                    sortable_selectbox();
                },
            });
        }

        sortable_selectbox();

        function sortable_selectbox(){
            $('.multiselect_sortable_content_'+defaults.rid+' select option').remove();
            $('.selection_content_'+defaults.rid+' .select_li_'+defaults.rid+'').each(function(i, e){

                var value = $(e).data('value');
                if(value!==undefined){

                    var opt      = document.createElement("option");
                    opt.text     = value;
                    opt.value    = value;
                    opt.selected = true;

                    //var MSS = document.createElement("input");
                    //MSS.setAttribute("type", "hidden");
                    //MSS.setAttribute("name", select_name+"[]");
                    //MSS.setAttribute("value", value);
                    //MSS.setAttribute("class", classes);
                    select.appendChild(opt);

                    //$('.multiselect_sortable_content').append(MSS)
                }

            })

            $('.multiselect_sortable_content_'+defaults.rid+'').append(select)

        }
    }

}(jQuery));