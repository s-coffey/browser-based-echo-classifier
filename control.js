$(document).on("changed.bs.select", "#select_cat", function() {
    if($("#select_view").is(":disabled"))
    {
        $("#select_view").prop("disabled", false);
        $("#select_view").selectpicker("refresh");
    }
    else
    {
        $("#select_view").find("option").remove().end();
        $("#select_view").selectpicker("refresh");
    }
    //
    var category = $("#select_cat").val();
    //
    document.getElementById("v_cat_b").className = "badge badge-success";
    document.getElementById("v_cat_b").textContent = category;
    //
    $.post("getViews.php", {
        category: category
        },
        function (data, status) {
            var toList = JSON.parse(data);
            $.each(toList, function (idx, obj) {
                $("#select_view").append("<option>" + obj + "</option>").selectpicker("refresh");
            });
        }
    );
});
//
$(document).on("changed.bs.select", "#select_view", function() {
    if($("#select_quality").is(":disabled"))
    {
        $("#select_quality").prop("disabled", false);
        $("#select_quality").selectpicker("refresh");
        //
        $.post("getQualityLevels.php", {},
            function (data, status) {
                var toList = JSON.parse(data);
                $.each(toList, function (idx, obj) {
                    $("#select_quality").append("<option>" + obj + "</option>").selectpicker("refresh");
                });
            }
        );
    }
    //
    var s_view = $("#select_view").val();
    //
    document.getElementById("v_b").className = "badge badge-success";
    document.getElementById("v_b").textContent = s_view;
});
//
$(document).on("changed.bs.select", "#select_quality", function() {
    if($("#next_b").is(":disabled"))
    {
        $("#next_b").prop("disabled", false);
    }
    //
    var s_qty = $("#select_quality").val();
    //
    document.getElementById("qty_b").className = "badge badge-success";
    document.getElementById("qty_b").textContent = s_qty;
});
//
function readFirstEcho()
{
    $.get("page_load_echo.php", {}, function (data, status) 
    {
        $(".echo_content").html(data);
    });
}
//
$(document).ready(function () 
{
    readFirstEcho();
    //
    getInfoBarData();
});
//
function nextB()
{
    var current_v_cat = document.getElementById("v_cat_b").textContent;
    var current_v = document.getElementById("v_b").textContent;
    var current_qty = document.getElementById("qty_b").textContent;
    //
    $.post("insert_current.php", {
        current_v_cat: current_v_cat,
        current_v: current_v,
        current_qty: current_qty
        },
        function (data, status) 
        {
            $.post("getNextTags.php", {},
                function (data, status) 
                {
                    var comp = "NA_NA_NA";
                    //
                    $.get("load_next.php", {}, function (data, status)
                    {
                        $(".echo_content").html(data);
                    });
                    //
                    if($("#select_cat").val())
                    {
                        $("#select_cat").val(null).trigger("change");
                    }
                    if(!$("#select_view").is(":disabled"))
                    {
                        $("#select_view").find("option").remove().end();
                        $("#select_view").prop("disabled", true);
                        $("#select_view").selectpicker("refresh");
                    }
                    if(!$("#select_quality").is(":disabled"))
                    {
                        $("#select_quality").find("option").remove().end();
                        $("#select_quality").prop("disabled", true);
                        $("#select_quality").selectpicker("refresh");
                    }
                    //
                    if((comp.localeCompare(data)) != 0)
                    {
                        var receivedString = data;
                        var valuesForBadges = receivedString.split("_");
                        var v_cat_badge = valuesForBadges[0];
                        var v_badge = valuesForBadges[1];
                        var qty_badge = valuesForBadges[2];
                        //
                        document.getElementById("v_cat_b").className = "badge badge-success";
                        document.getElementById("v_cat_b").textContent = v_cat_badge;
                        //
                        document.getElementById("v_b").className = "badge badge-success";
                        document.getElementById("v_b").textContent = v_badge;
                        //
                        document.getElementById("qty_b").className = "badge badge-success";
                        document.getElementById("qty_b").textContent = qty_badge;
                    }
                    else
                    {
                        document.getElementById("v_cat_b").className = "badge badge-danger";
                        document.getElementById("v_cat_b").textContent = "No view category";
                        //
                        document.getElementById("v_b").className = "badge badge-danger";
                        document.getElementById("v_b").textContent = "No view";
                        //
                        document.getElementById("qty_b").className = "badge badge-danger";
                        document.getElementById("qty_b").textContent = "No quality";
                        //
                        $("#next_b").prop("disabled", true);
                    }
                }
            );
        }
    );
}
//
function previousB()
{
    $.post("get_previous.php", {},
        function (data, status)
        {
            var comp = "NA_NA_NA";
            if((comp.localeCompare(data)) != 0)
            {
                var receivedString = data;
                var valuesForBadges = receivedString.split("_");
                var v_cat_badge = valuesForBadges[0];
                var v_badge = valuesForBadges[1];
                var qty_badge = valuesForBadges[2];
                //
                document.getElementById("v_cat_b").className = "badge badge-success";
                document.getElementById("v_cat_b").textContent = v_cat_badge;
                //
                document.getElementById("v_b").className = "badge badge-success";
                document.getElementById("v_b").textContent = v_badge;
                //
                document.getElementById("qty_b").className = "badge badge-success";
                document.getElementById("qty_b").textContent = qty_badge;
            }
            else
            {
                document.getElementById("v_cat_b").className = "badge badge-danger";
                document.getElementById("v_cat_b").textContent = "No view category";
                //
                document.getElementById("v_b").className = "badge badge-danger";
                document.getElementById("v_b").textContent = "No view";
                //
                document.getElementById("qty_b").className = "badge badge-danger";
                document.getElementById("qty_b").textContent = "No quality";
            }
            //
            $.get("load_previous.php", {}, function (data, status)
            {
                $(".echo_content").html(data);
            });
            //
            if($("#select_cat").val())
            {
                $("#select_cat").val(null).trigger("change");
            }
            if(!$("#select_view").is(":disabled"))
            {
                $("#select_view").find("option").remove().end();
                $("#select_view").prop("disabled", true);
                $("#select_view").selectpicker("refresh");
            }
            if(!$("#select_quality").is(":disabled"))
            {
                $("#select_quality").find("option").remove().end();
                $("#select_quality").prop("disabled", true);
                $("#select_quality").selectpicker("refresh");
            }
            //
            if($("#next_b").is(":disabled"))
            {
                $("#next_b").prop("disabled", false);
            }
        }
    );
}
//
function getInfoBarData()
{
    var totS = 16509;
    //
    $.post("display_info_bar.php", {},
        function (data, status) 
        {
            var comS = parseInt(data);
            //
            var reS = totS - comS;
            //
            document.getElementById("total").textContent = totS;
            document.getElementById("completed").textContent = comS;
            document.getElementById("remaining").textContent = reS;
        }
    );
}