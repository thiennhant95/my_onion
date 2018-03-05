<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * CSV Helpers
 *
 * @author Tran Thien Nhan
 */

// ------------------------------------------------------------------------

/**
 * Array to CSV
 *
 * download == "" -> return CSV string
 * download == "toto.csv" -> download file toto.csv
 */
if ( ! function_exists('array_to_csv'))
{
    function array_to_csv($array, $download = "")
    {
        if(!$array)
            throw new Exception('ASINがみつかりませんでした。');

        header('Cache-Control: public');
        header('Pragma: public');
        header('Content-Type: application/octet-stream');
        header(sprintf("Content-Disposition: attachment;filename=".$download));
        header('Content-Transfer-Encoding: binary');

        $fp = fopen('php://temp', 'r+b');
        foreach($array as $item){
            $repl = str_replace(array('"', "\n"), array('\"', '\n'), $item);
            foreach ($repl as $row_array):
                fputcsv($fp, $row_array);
            endforeach;
        }
        rewind($fp);
        $temp = str_replace(PHP_EOL, "\r\n", stream_get_contents($fp));
        echo mb_convert_encoding($temp, 'SJIS-win', 'UTF-8');
        fclose($fp);
        exit;
    }

}

// ------------------------------------------------------------------------

/**
 * Query to CSV
 *
 * download == "" -> return CSV string
 * download == "toto.csv" -> download file toto.csv
 */
if ( ! function_exists('query_to_csv'))
{
    function query_to_csv($query, $headers = TRUE, $download = "")
    {
        if ( ! is_object($query) OR ! method_exists($query, 'list_fields'))
        {
            show_error('invalid query');
        }

        $array = array();

        if ($headers)
        {
            $line = array();
            foreach ($query->list_fields() as $name)
            {
                $line[] = $name;
            }
            $array[] = $line;
        }
        foreach ($query->result_array() as $row)
        {
            $line = array();
            foreach ($row as $item)
            {
                $line[] = $item;
            }
            $array[] = $line;
        }

        echo array_to_csv($array, $download);
    }
    function EscapeForCSV($value)
    {
        return '"' . str_replace('"', '""', $value) . '"';
    }
}

/* End of file csv_helper.php */
/* Location: ./system/helpers/csv_helper.php */

//export CSV member : dev: TRÍ_PHP

if ( ! function_exists('export_csv_member'))
{
    function export_csv_member($array, $download = "")
    {
        if(!$array)
            throw new Exception('ASINがみつかりませんでした。');

        header('Cache-Control: public');
        header('Pragma: public');
        header('Content-Type: application/octet-stream');
        header(sprintf("Content-Disposition: attachment;filename=".$download));
        header('Content-Transfer-Encoding: binary');

        $fp = fopen('php://temp', 'r+b');
        // foreach($array as $item){
        //     $repl = str_replace(array('"', "\n"), array('\"', '\n'), $item);
            foreach ($array as $row_array):
                $tmp_arr = str_replace(array('"', "\n"), array('\"', '\n'), $row_array);
                fputcsv($fp, $tmp_arr);
            endforeach;
        // }
        rewind($fp);
        $temp = str_replace(PHP_EOL, "\r\n", stream_get_contents($fp));
        echo mb_convert_encoding($temp, 'SJIS-win', 'UTF-8');
        fclose($fp);
        exit;
    }

}
