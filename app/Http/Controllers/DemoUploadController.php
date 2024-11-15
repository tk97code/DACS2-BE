<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\Element\AbstractContainer;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007\Element\Text;

class DemoUploadController extends Controller
{
    public function index() {
        return view('upload_test');
    }

    public function handleUpload(Request $request) {

        // $request = request()->validate([
        //     'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
        // ]);
        // dd(request()->file('file-upload'));
        $fileName = $request->file('file-upload');
        // $fileName = $_FILES["file-upload"]["tmp_name"];

        // $fileName = $_FILES["file"]["tmp_name"];
        // $request->file('file-upload')->storeAs('upload', $fileName, 'public');
        
        $reader = IOFactory::createReader('Word2007');
        $word = $reader->load($fileName);

        $text = '';

        function getWordText($element)
            {
                $result = '';
                $class = get_class($element);
                if (method_exists($class, 'getText')) {
                    $result .= $element->getText();
                } else {
                    $result .= "\n";
                }
                return $result;
            }

            foreach ($word->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    $text .= trim(getWordText($element));
                    $text .= "\\n";
                }
            }


        $text = rtrim($text, "\\n");
        substr($text, -1);
        $questions = explode("\\n\\n", $text);
        $arrques = array();
        for ($i = 0; $i < count($questions); $i++) {
            $data = explode("\\n", $questions[$i]);
            $arrques[$i]['level'] = substr($data[0], 1, 1);
            $arrques[$i]['question'] = substr(trim($data[0]), 4);
            $arrques[$i]['answer'] = ord(trim(substr($data[count($data) - 1], 8))) - 65 + 1;
            $arrques[$i]['option'] = array();
            for ($j = 1; $j < count($data) - 1; $j++) {
                $arrques[$i]['option'][] = trim(substr($data[$j], 3));
            }
        }

        // dd($arrques);
        return json_encode($arrques);

        // return view('upload_test', ['questions' => $arrques]);


        // foreach ($word->getSections() as $section) {
        //     foreach ($section->getElements() as $element) {
        //         $class = get_class($element);
        //         if (method_exists($class, 'getText')) {
        //             $text .= $element->getText();
        //         } else {
        //             $text .= "\n";
        //         }
        //     }
        //     // and so on for other element types (see src/PhpWord/Element)
        // }

    }
}
