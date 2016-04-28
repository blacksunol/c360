<?php
class Pagination{
    private $totalItems;					// Tổng số phần tử
    private $totalItemsPerPage;	// Tổng số phần tử xuất hiện trên một trang
    private $pageRange;	// Số trang xuất hiện
    private $totalPage;						// Tổng số trang
    private $currentPage;	// Trang hiện tại

    public function __construct($totalItems, $pagination){
        $this->totalItems			= $totalItems;
        $this->totalItemsPerPage	= $pagination['totalItemsPerPage'];
        if($pagination['pageRange'] %2 == 0) $pagination['pageRange'] = $pagination['pageRange']+ 1;
        $this->pageRange			= $pagination['pageRange'];
        $this->currentPage			= $pagination['currentPage'];
        $this->totalPage			= ceil($totalItems/$pagination['totalItemsPerPage']);
    }
    public function showPagination($link){
        $paginationHTML = '';
        if($this->totalPage > 1){
            $start 	= '<span class="active">Đầu</span>';
            $prev 	= '<span class="active">Trước</span>';
            if($this->currentPage > 1){
                $start 	= '<span class="link"><a href="'.$link.'&page=1">Đầu</a></span>';
                $prev 	= '<span class="link"><a href="'.$link.'&page='.($this->currentPage-1).'">Trước</a></span>';
            }

            $next 	= '<span class="active">Sau</span>';
            $end 	= '<span class="active">Cuối</span>';
            if($this->currentPage < $this->totalPage){
                $next 	= '<span class="link"><a onclick="javascript:changePage('.($this->currentPage+1).')" href="'.$link.'&page='.($this->currentPage+1).'">Sau</a></span>';
                $end 	= '<span class="link"><a href="'.$link.'&page='.($this->totalPage).'">Cuối</a></span>';
            }

            if($this->pageRange < $this->totalPage){
                    if($this->currentPage == 1){
                        $startPage 	= 1;
                        $endPage 	= $this->pageRange;
                    }else if($this->currentPage == $this->totalPage){
                        $startPage		= $this->totalPage - $this->pageRange + 1;
                        $endPage		= $this->totalPage;
                    }else{
                        $startPage		= $this->currentPage - ($this->pageRange-1)/2;
                        $endPage		= $this->currentPage + ($this->pageRange-1)/2;
                        if($startPage < 1){
                            $endPage	= $endPage + 1;
                            $startPage = 1;
                        }
                        if($endPage > $this->totalPage){
                            $endPage	= $this->totalPage;
                            $startPage 	= $endPage - $this->pageRange + 1;
                        }
                    }
            }else{
                $startPage		= 1;
                $endPage		= $this->totalPage;
            }
            $listPages = '';
            for($i = $startPage; $i <= $endPage; $i++){
                if($i == $this->currentPage) {
                    $listPages .= '<span class="active">'.$i.'</span>';
                }else{
                    $listPages .= '<span class="link"><a href="'.$link.'&page='.$i.'" >'.$i.'</a></span>';
                }
            }
            
            $endPagination	= '<span class="page-text">Trang '.$this->currentPage.' / '.$this->totalPage.'</span>';
            $paginationHTML = '<div id="paging">' . $start . $prev . $listPages . $next . $end . $endPagination . '</div>';
        }
        return $paginationHTML;
    }
}