<?php
namespace Yar\Server;
/**
 * 列出所有支持的方法
 * User: NeilZeng<zwjzxh520@gmail.com>
 * Date: 2017/4/4
 * Time: 16:28
 */

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';


class ApiList
{
    /**
     * 列出所有的php文件。
     * 排除了根目录下的apilist.php和index.php文件。这两个为api下特殊的php文件
     * @param $dir
     * @param bool|true $root
     * @return \Generator
     */
    public static function listPHPFile($dir, $root = true)
    {
        $handle = opendir($dir);
        if ($handle) {
            while ($file = readdir($handle)) {
                if ($file !== '.' && $file !== '..') {
                    if ($root === false || ($file !== 'index.php' && $file !== 'apilist.php')) {
                        if (is_dir($dir . '/' . $file)) {
                            $result = self::listPHPFile($dir . '/' . $file, false);
                            yield $result->current();
                        } else {
                            yield $dir . '/' . $file;
                        }
                    }
                }
            }
            closedir($handle);
        }
    }

    /**
     * 打印所有api列表，及api注释。
     */
    public function show()
    {
        $preFilePathLen = strlen(__DIR__) + 1;
        $allApi = $apiDocComment = [];
        $nameSpace = 'Yar\\Server\\';
        foreach (self::listPHPFile(__DIR__) as $file) {
            $fileNameSpace = substr($file, $preFilePathLen, -4);
            $allApi[] = str_replace('/', '\\', $fileNameSpace);
            $apiDocComment[] = $this->docDocument($nameSpace.current($allApi));
        }

        foreach ($allApi as $key => $api) {
            echo "<pre>{$apiDocComment[$key]}</pre>";
            echo "<a href='./?m={$api}' target='_blank'>$api</a> <br />";
        }
    }

    /**
     * 获取 class 的 doc block。而不是文件的docker block。
     * token_get_all 函数可以分析php源码。
     * ZF框架的Zend_Reflection_File方法也可以做此类功能。
     * @param $class
     * @return string
     */
    public function docDocument($class)
    {
        $rc = new \ReflectionClass($class);
        return $rc->getDocComment();
    }
}

(new ApiList())->show();