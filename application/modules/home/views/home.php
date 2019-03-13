<?= breadcrumbs("Ana Sayfa", "fa-home") ?>
<style type="text/css">

    .calendar {
        font-size: 25px;
        width: 100%;
        min-width: 960px;
        border-collapse: collapse;
        text-align: center !;
    }

    .calendar tbody tr:first-child th {
        color: #505050;
        margin: 0 0 10px 0;
    }

    .day_header {
        font-weight: bold;
        text-align: center;
        font-size: 15px;
        color: white;

    }

    .calendar td {

        width: 14%; /* Force all cells to be about the same width regardless of content */
        border: 2px solid #d5d5d5;
        height: 120px;

        vertical-align: top;
        font-size: 15px;
        padding: 0;
        font-weight: bold;
        text-align: center;

    }

    .calendar td:hover {
        background: #F3F3F3;
    }

    .day_listing {
        display: block;
        text-align: right;
        font-size: 20px;
        padding: 5px 5px 0 0;
        color: #3c8dbc;

    }

    div.today {
        background: #E9EFF7;
        font-weight: bold;
        text-align: center;
        color: #000000;
        font-size: 15px;
        height: 100%;

    }

    td {
        width: 50px;
        height: 50px;
        text-align: center;
        border: 1px solid #e2e0e0;
        font-size: 18px;
        font-weight: bold;
    }

    th {
        height: 50px;
        padding-bottom: 8px;
        background: #605ca8;
        font-size: 20px;

    }

    tr th[colspan="5"] {
        color: white!important;
    }

    th a {
        color: white;
        font-size: 20px;
        padding-left: 50px;

    }

    .day_header {
        color: white;
    }

</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="table-responsive" style="background-color: #fff">
                <?php
                echo $calendar
                ?>
            </div>

        </div>
    </div>
</section>

