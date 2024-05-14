<?php

namespace app\controller;

use think\Request;
use think\Db;

class GetHotArea
{
    public function index(Db $db)
    {
        $items = $db->table('item')->select();

        if ($items) {
            $data = [];
            foreach ($items as $item) {
                $data[] = [
                    'id' => $item['i_id'],
                    'title' => $item['i_title'],
                    'imageUrl' => $item['i_img']
                ];
            }

            $returnValue = [
                "code" => 200,
                "value" => $data
            ];

            return json($returnValue);
        } else {
            $returnValue = [
                "code" => 100,
                "value" => "Error fetching data from the database"
            ];

            return json($returnValue);
        }
    }

    public function search_with_iid(Request $request, Db $db)
    {
        $iid = $request->get('iid', 0);
        $hotareas_String = $db->table('hotareas')->where('iid', $value)->pluck('json')->first();
        $data = json_decode($hotareas_String, true);
        if ($data !== null) {
            $returnValue = [
                "code" => 200,
                "value" => $data
            ];
            return json($returnValue);
        } else {
            $returnValue = [
                "code" => 100,
                "value" => "Error decoding JSON data"
            ];
            return json($returnValue);
        }
    }
}
