<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/6
 * Time: 11:12
 */

namespace Ypk;

/**
 * hpf
 *
 * 生成Excel文件类
 *
 * Class Excel
 * @package Ypk
 */
class Excel
{
    /**
     * excel文档头(返回的行)
     *
     * 依照excel xml规范。
     * @access private
     * @var string
     */
    private $header = "<?xml version=\"1.0\" encoding=\"UTF-8\"?\>
	<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\"
	xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
	xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\"
	xmlns:html=\"http://www.w3.org/TR/REC-html40\">";

    /**
     * excel页脚
     * 依照excel xml规范。
     *
     * @access private
     * @var string
     */
    private $footer = "</Workbook>";

    /**
     * 文档行(行数组中)
     *
     * @access private
     * @var array
     */
    private $lines = array();
    /**
     * 工作表(数组)
     *
     * @access private
     * @var array
     */
    private $worksheets = array();
    /**
     * 单元格样式
     * @access private
     * @var string
     */
    private $cellstyle = array();

    /**
     * 默认单元格数据格式
     * @access private
     * @var string
     */
    private $default_cellformat = "String";

    public function __construct()
    {
        //设置默认样式
        $this->cellstyle['Default'] = '<Style ss:ID="Default" ss:Name="Normal">
			   <Alignment ss:Vertical="Center"/>
			   <Borders/>
			   <Font ss:FontName="宋体" x:CharSet="134" ss:Size="11" ss:Color="#000000"/>
			   <Interior/>
			   <NumberFormat/>
			   <Protection/>
			  </Style>';
    }

    /**
     * 添加单行数据
     *
     * @access private
     * @param array 1维数组
     * @todo 行创建
     */
    private function addRow($array)
    {
        //初始化单元格
        $cells = "";
        //构建单元格
        foreach ($array as $k => $v) {
            $style_str = '';
            if (!empty($v['styleid'])) {
                $style_str = 'ss:StyleID="' . $v['styleid'] . '"';
            }
            $format_str = $this->default_cellformat;
            if (!empty($v['format'])) {
                $format_str = $v['format'];
            }
            $cells .= "<Cell {$style_str} ><Data ss:Type=\"{$format_str}\">{$v['data']}</Data></Cell>\n";
        }
        //构建行数据
        $this->lines[] = "<Row>\n" . $cells . "</Row>\n";
    }

    /**
     * 添加多行数据
     * @access public
     * @param array 2维数组
     * @todo 构造多行
     */
    public function addArray($array)
    {
        $this->lines = array();
        //构建行数据
        foreach ((array)$array as $k => $v) {
            $this->addRow($v);
        }
    }

    /**
     * 添加工作表
     * @access public
     * @param string $sheettitle 工作表名
     * @todo 构造工作表XML
     */
    public function addWorksheet($sheettitle)
    {
        //剔除特殊字符
        $sheettitle = preg_replace("/[\\\|:|\/|\?|\*|\[|\]]/", "", $sheettitle);
        //现在,将其减少到允许的长度
        //$sheettitle = substr ($sheettitle, 0, 50);
        $this->worksheets[] = "\n<Worksheet ss:Name=\"$sheettitle\">\n<Table ss:DefaultRowHeight=\"20\">\n" .
            "<Column ss:Index=\"1\" ss:AutoFitWidth=\"0\"/>\n" .
            implode("\n", $this->lines) .
            "</Table>\n</Worksheet>\n";
    }

    /**
     * 设置单元格样式
     *
     * @access public
     * @param array 样式数组例如： array('id'=>'s_title','Font'=>array('FontName'=>'宋体','Size'=>'12','Bold'=>'1'));
     * 当id为Default时，为表格的默认样式
     */
    public function setStyle($style_arr)
    {
        if (empty($style_arr)) {
            return false;
        }
        $id = $style_arr['id'];
        unset($style_arr['id']);
        $style_str = "<Style ss:ID=\"$id\">";
        foreach ($style_arr as $k => $v) {
            $tmp = '';
            foreach ((array)$v as $k_item => $v_item) {
                $tmp .= (" ss:$k_item=\"$v_item\"");
            }
            $style_str .= "<$k " . $tmp . '/>';
        }

        $this->cellstyle[$id] = $style_str . '</Style>';
    }

    /**
     * 设置默认单元格格式
     *
     * @access public
     * @param string
     */
    public function setDefaultFormat($format_str)
    {
        if (empty($style_arr)) {
            return false;
        }
        $this->default_cellformat = $format_str;
    }

    /**
     * 生成xml文件
     * 最后生成excel文件,并使用header()函数来将它交付给浏览器。
     * @access public
     * @param string $filename 文件名称
     */
    public function generateXML($filename)
    {
        $encoded_filename = urlencode($filename);
        $encoded_filename = str_replace("+", "%20", $encoded_filename);
        //头
        $ua = $_SERVER["HTTP_USER_AGENT"];

        ob_clean(); //清除缓冲区,避免乱码

        header("Content-Type: application/vnd.ms-excel");
        if (preg_match("/MSIE/", $ua)) {
            header('Content-Disposition: attachment; filename="' . $encoded_filename . '.xls"');
        } else if (preg_match("/Firefox/", $ua)) {
            header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '.xls"');
        } else {
            header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
        }
        header('Cache-Control: max-age=0');
        echo stripslashes($this->header);
        //样式
        echo "\n<Styles>";
        foreach ((array)$this->cellstyle as $k => $v) {
            echo "\n" . $v;
        }
        echo "\n</Styles>";
        //工作表
        echo implode("\n", $this->worksheets);
        echo $this->footer;
    }

    /**
     * 生成excel文件
     * 最后生成excel文件,并使用header()函数来将它交付给浏览器。
     * @access public
     * @param string $filename 文件名称
     * @param array $excel_data 文件名称
     */
    public function generateXLS($filename, $excel_data)
    {
        $encoded_filename = urlencode($filename);
        $encoded_filename = str_replace("+", "%20", $encoded_filename);
        //头
        $ua = $_SERVER["HTTP_USER_AGENT"];

        /** Include PHPExcel */
        require_once BASE_API_PATH . '/PHPExcel/PHPExcel.php';

        // Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("逸陪康商城")
            ->setLastModifiedBy("逸陪康商城")
            ->setTitle("Office 2007 XLSX " . $filename)
            ->setSubject("Office 2007 XLSX " . $filename)
            ->setDescription("Test document for Office 2007 XLSX 名称" . $filename)
            ->setKeywords("office 2007 " . $filename)
            ->setCategory("Test result file" . $filename);

        $column_count = count($excel_data[0]);

        $line_letter_arr = array();
        for ($i = 0; $i < $column_count; $i++) {
            //求出当前值是26进制几位数
            $num26 = base_convert($i, 10, 26);
            //将字符串转字符数组
            $num26_letter_arr = str_split($num26);
            if (count($num26_letter_arr) > 1) {
                $num26_letter_arr[0]--;
            }
            $line_letter = '';
            foreach ($num26_letter_arr as $num26_letter) {
                $letter = str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p'),
                    array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'),
                    $num26_letter);
                $line_letter .= $letter;
            }
            $line_letter_arr[] = $line_letter;
        }

        foreach ($excel_data as $row => $excel_row) {
            foreach ($excel_row as $column => $excel_column) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($line_letter_arr[$column] . ($row + 1), $excel_column['data']);
            }
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($filename);


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        ob_clean(); //清除缓冲区,避免乱码

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        if (preg_match("/MSIE/", $ua)) {
            header('Content-Disposition: attachment; filename="' . $encoded_filename . '.xls"');
        } else if (preg_match("/Firefox/", $ua)) {
            header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '.xls"');
        } else {
            header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
        }
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    /**
     * 转码函数
     *
     * @param mixed $content
     * @param string $from
     * @param string $to
     * @return mixed
     */
    public function charset($content, $from = 'gbk', $to = 'utf-8')
    {
        $from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
        $to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
        if (strtoupper($from) === strtoupper($to) || empty($content)) {
            //如果编码相同则不转换
            return $content;
        }
        if (function_exists('mb_convert_encoding')) {
            if (is_array($content)) {
                $content = var_export($content, true);
                $content = mb_convert_encoding($content, $to, $from);
                eval("\$content = $content;");
                return $content;
            } else {
                return mb_convert_encoding($content, $to, $from);
            }
        } elseif (function_exists('iconv')) {
            if (is_array($content)) {
                $content = var_export($content, true);
                $content = iconv($from, $to, $content);
                eval("\$content = $content;");
                return $content;
            } else {
                return iconv($from, $to, $content);
            }
        } else {
            return $content;
        }
    }
}