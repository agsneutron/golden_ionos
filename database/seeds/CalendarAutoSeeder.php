<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CalendarSeeder extends Seeder
{
    public function run(): void
    {
        $start = Carbon::create(2026, 1, 1);
        $end   = Carbon::create(2026, 12, 31);

        while ($start->lte($end)) {

            DB::table('calendar')->insertOrIgnore([
                'day' => $start->format('Y-m-d'),
                'name' => $start->translatedFormat('l, d \\d\\e F \\d\\e\\l Y'),
                'year' => $start->year,
                'month' => $start->translatedFormat('F'),
                'month_number' => $start->month,
                'day_of_the_year' => $start->dayOfYear,
                'weekday' => $start->dayOfWeekIso,
                'day_of_the_month' => $start->day,
                'name_day' => $start->translatedFormat('l'),
                'short_name' => mb_strtoupper($start->translatedFormat('D')),
                'week' => $start->weekOfYear,
                'bimester' => (int) ceil($start->month / 2),
                'trimester' => (int) ceil($start->month / 3),
                'semestre' => $start->month <= 6 ? 1 : 2,
            ]);

            $start->addDay();
        }
    }
}
