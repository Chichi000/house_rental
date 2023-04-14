<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use Auth;
use Askedio\Laravel5ProfanityFilter\ProfanityFilter;

class ReviewController extends Controller
{
    //store comment of tenant
    public function store(Request $request)
    {
        // $config = []; // Data from `resources/config/profanity.php`
        // $badWordsArray = []; // Data from `resources/lang/[lang]/profanity.php`
        // dd($request['comment']);
        // $profanityFilter =  new ProfanityFilter($config, $badWordsArray);
        // $string = app('profanityFilter')->replaceWith('#')->replaceFullWords(false)->filter('shit');

        $config = ['replaceFullWords' => true,


        'replaceWith' => '*',


        'strReplace' => [
                'a' => '(a|a\.|a\-|4|@|Á|á|À|Â|à|Â|â|Ä|ä|Ã|ã|Å|å|α|Δ|Λ|λ)',
                'b' => '(b|b\.|b\-|8|\|3|ß|Β|β)',
                'c' => '(c|c\.|c\-|Ç|ç|¢|€|<|\(|{|©)',
                'd' => '(d|d\.|d\-|&part;|\|\)|Þ|þ|Ð|ð)',
                'e' => '(e|e\.|e\-|3|€|È|è|É|é|Ê|ê|∑)',
                'f' => '(f|f\.|f\-|ƒ)',
                'g' => '(g|g\.|g\-|6|9)',
                'h' => '(h|h\.|h\-|Η)',
                'i' => '(i|i\.|i\-|!|\||\]\[|]|1|∫|Ì|Í|Î|Ï|ì|í|î|ï)',
                'j' => '(j|j\.|j\-)',
                'k' => '(k|k\.|k\-|Κ|κ)',
                'l' => '(l|1\.|l\-|!|\||\]\[|]|£|∫|Ì|Í|Î|Ï)',
                'm' => '(m|m\.|m\-)',
                'n' => '(n|n\.|n\-|η|Ν|Π)',
                'o' => '(o|o\.|o\-|0|Ο|ο|Φ|¤|°|ø)',
                'p' => '(p|p\.|p\-|ρ|Ρ|¶|þ)',
                'q' => '(q|q\.|q\-)',
                'r' => '(r|r\.|r\-|®)',
                's' => '(s|s\.|s\-|5|\$|§)',
                't' => '(t|t\.|t\-|Τ|τ)',
                'u' => '(u|u\.|u\-|υ|µ)',
                'v' => '(v|v\.|v\-|υ|ν)',
                'w' => '(w|w\.|w\-|ω|ψ|Ψ)',
                'x' => '(x|x\.|x\-|Χ|χ)',
                'y' => '(y|y\.|y\-|¥|γ|ÿ|ý|Ÿ|Ý)',
                'z' => '(z|z\.|z\-|Ζ)',
        ],


        'defaults' => [
            'fuck',
            'shit',
            'anal',
            'anus',
            'arse',
            'ass',
            'ballsack',
            'balls',
            'bastard',
            'bitch',
            'biatch',
            'bloody',
            'blowjob',
            'bollock',
            'bollok',
            'boner',
            'boob',
            'bugger',
            'bum',
            'butt',
            'buttplug',
            'clitoris',
            'cock',
            'coon',
            'crap',
            'cunt',
            'damn',
            'dick',
            'dildo',
            'dyke',
            'fag',
            'feck',
            'fellate',
            'fellatio',
            'felching',
            'fuck',
            'fudgepacker',
            'flange',
            'goddamn',
            'hell',
            'homo',
            'jizz',
            'knobend',
            'labia',
            'muff',
            'nigger',
            'nigga',
            'penis',
            'piss',
            'poop',
            'prick',
            'pube',
            'pussy',
            'queer',
            'scrotum',
            'sex',
            'shit',
            'sh1t',
            'slut',
            'smegma',
            'spunk',
            'suck',
            'tit',
            'tosser',
            'turd',
            'twat',
            'vagina',
            'wank',
            'whore',
            'wtf',
            'gago',
            'tangina',
            'pota',
            'potangina',
            'bobo',

        ],]; // Data from `resources/config/profanity.php`
        $badWordsArray = []; // Data from `resources/lang/[lang]/profanity.php`

        $profanityFilter =  new ProfanityFilter($config, $badWordsArray);
        $string = $profanityFilter->replaceWith('*')->replaceFullWords(false)->filter($request->comment);

        //check if someone is login
        if (Auth::check()) {

            //check if user already have a review
            $reviews = Review::where('property_id', $request->property_id)
                ->where('user_id', Auth::user()->id)
                ->first();

            //validate the comment
            $this->validate($request, [
                'comment' => 'required'
            ]);

            //if tenant already have comment then it will only update the comment
            if ($reviews) {
                $reviews->comment = $string;
                $reviews->save();
            }

            //else when user doesn't comment yet
            else {
                $reviews = new Review;
                $reviews->user_id = Auth::user()->id;
                $reviews->property_id = $request->property_id;
                $reviews->comment = $string;
                $reviews->save();
            }

            return redirect()->back()->with('success', 'Thanks for the review!');

        }

        //else when no one is login
        else {
            return redirect()->back()->with('warning', 'Please sign-in first.');
        }



    }
}
