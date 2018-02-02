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
        if ($download != "")
        {
            header('Content-Description: File Transfer');
            header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");
            header('Content-Disposition: attachment; filename='.$download);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            echo "\xFF\xFE"; // UTF-16 LE
        }
        ob_start();
        $f = fopen('php://output', 'w') or show_error("Can't open php://output");
        $n = 0;
         foreach ($array as $line)
        {
            foreach ($line as $row):
                $n++;
                if ( ! fputcsv($f, $row, "\t"))
                    {
                    show_error("Can't write line $n: $row");
                }
            endforeach;
        }
        fclose($f) or show_error("Can't close php://output");

        $str = ob_get_contents();

        ob_end_clean();
        $str = mb_convert_encoding($str, 'UTF-16LE', 'UTF-8');

        if ($download == "")
        {
            return $str;
        }
        else
        {
            echo $str;
        }
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