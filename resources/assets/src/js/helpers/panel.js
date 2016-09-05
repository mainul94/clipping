/**
 * Created by mainul on 3/31/16.
 */

/**
 * this function for format select2 data
 * @param state
 * @returns {*}
 */
function formatState (state) {
    if (!state.id) { return state.text; }
    var $state = $(
        '<span>' + state.text + '</span>'
    );
    return $state;
}

function filtersForSelect2Dependancy(filters) {
    if (filters.length <1) {
        return filters
    }
    var newFilter = [];
    $.each(filters, function (k,v) {
        var fl = [v[0]]

        if (typeof v[1] === 'undefined') {
            fl.push('=')
        }else {
            fl.push(v[1])
        }

        fl.push((typeof v[2] === 'undefined'?"":"%")+$('[name="'+v[0]+'"]').val()+(typeof v[3] === 'undefined'?"":"%"))

        newFilter.push(fl)

    });

    return newFilter
}

/**
 * this function for select2 with ajax data
 * @param selector
 * @param table
 * @param select
 * @param filters //set as array Ex:[['fieldname'],['fieldname','oparetion(=)','like_start','like_end']]
 * @param f_k
 * @param f_v
 */
function getvalueForSelect2(selector,table,select,filters,f_k,f_v,defaultValue) {

    var $selecttor = $(selector).select2({
        ajax: {
            url: "/api/getvalue",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    table:table,
                    select:select,
                    filters:filtersForSelect2Dependancy(filters),
                    search_key:f_v,
                    search:params.term,
                    page: params.page
                };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;
                var newdata = [];
                $.each(data, function (k,v) {
                    newdata.push({'id': v[f_k],'text': v[f_v]})
                });
                return {

                    results: newdata,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        /*initSelection:function (item,callback){
            if (defaultValue) {
                callback(defaultValue);
            }
        },*/
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 0,
        templateResult: formatState, // omitted for brevity, see the source of this page
        placeholder: 'Select an option'
    });
    //callback($selecttor)
}



//Get Value

function getValue(url,callback) {
    $.ajax({
        url:url,
        success: function (data) {
            callback(data)
        },
        complete: function (xhr) {
            //console.log(xhr)
        }
    });
}

// Search Sting Start with Prototype
if(!String.prototype.startsWith){
    String.prototype.startsWith = function (str) {
        return !this.indexOf(str);
    }
}

function leftPad(n, width, z) {
    z = z || '0';
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}