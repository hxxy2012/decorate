<?php  
namespace app\admin\model;

use think\Loader;

class DesignerProduce extends Base
{
    
     protected $pageSize = 20;

     protected $auto = ['update_at'];


    protected $rule = [
        'name' => 'require',
        'img_url'=>'require',
        'introduce'=>'require'
    ];

    protected $message = [
        'name.require' => '作品名字不能为空',
        'img_url.require' => '请先上传图片',
        'introduce.require' => '作品简介不能为空'
    ];


    /**
     * 根据设计者id查询作品集
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showProduce(array $where,$pageSize = null,$config)
    {   
        $pageSize = $pageSize ? : $this->pageSize;
        return $this->where($where)->field(true)->paginate($pageSize,false,$config);
    }

    /**
     * 删除作品集和作品集下的图片
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteProduce($id){
        $data1 = self::deleteOne($id);
        $data2 = Loader::model('DesignerProduceImg')->deleteByProduceId($id);
        if(isset($data1) && isset($data2)){
            return ['code'=>1,'msg'=>'删除成功'];
        }else{
            return ['code'=>0,'msg'=>'删除失败'];
        } 
    }

    /**
     * 根据设计者id删除作品集
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function deleteByDesignerId($id)
    {
        return $this->field(true)->where('designer_id',$id)->delete();
    }

    public function setUpdateAtAttr($value)
    {
        return date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
    }


}