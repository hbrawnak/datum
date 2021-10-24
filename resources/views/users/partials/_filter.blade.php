<div class="row">
    <form class="row g-3" action="/" method="get">
        <div class="col-auto">
            <label for="birthYear" class="visually-hidden">Birth Year</label>
            <input type="number" name="year" class="form-control" id="birthYear" placeholder="Birth Year"
                   value="{{ $year }}">
        </div>
        <div class="col-auto">
            <label for="birthMonth" class="visually-hidden">Birth Month</label>
            <input type="number" name="month" class="form-control" id="birthMonth" placeholder="Birth Month"
                   value="{{ $month  }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-warning mb-3">Filter</button>
        </div>
    </form>
</div>
