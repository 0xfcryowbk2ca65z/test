<?php
#curl 并发例子
function non_blocking_get( $url_array, $max = 8, $timeout = 8, $overtime = 0, $log = false )
	{
		$index = 0;
		$need = count( $url_array );
		$total = $need;
		$max = $need < $max ? $need : $max;
		$multi = curl_multi_init();
		$result = array();

		for( $i = 0; $i < $max; $i++ )
		{
			$single = curl_init();
			curl_setopt( $single, CURLOPT_URL, $url_array[$index++] );
			curl_setopt( $single, CURLOPT_TIMEOUT, $timeout );
			curl_setopt( $single, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $single, CURLOPT_HEADER, 0 );
			curl_setopt( $single, CURLOPT_NOSIGNAL, true );
			curl_multi_add_handle( $multi, $single );
		}

		do
		{
			if ( ( $status = curl_multi_exec( $multi, $active ) ) != CURLM_CALL_MULTI_PERFORM )
			{
				if ( $status != CURLM_OK ) break;

				while( $done = curl_multi_info_read( $multi ) )
				{
					$need--;

					if ( $need > 0 && isset( $url_array[$index] ) )
					{
						$single = curl_init();
						curl_setopt( $single, CURLOPT_URL, $url_array[$index++] );
						curl_setopt( $single, CURLOPT_TIMEOUT, $timeout );
						curl_setopt( $single, CURLOPT_RETURNTRANSFER, 1 );
						curl_setopt( $single, CURLOPT_HEADER, 0 );
						curl_setopt( $single, CURLOPT_NOSIGNAL, true );
						curl_multi_add_handle( $multi, $single );
					}

					$info = curl_getinfo( $done['handle'] );

					if ( $log )
					{
						echo $info['total_time'] . "\t" . $info['http_code'] . "\t" . round( ( $total - $need ) * 100 / $total, 2 ) . "%\n";
					}

					$result[ $info['url'] ] = curl_multi_getcontent( $done['handle'] );
					curl_multi_remove_handle( $multi, $done['handle'] );
					curl_close( $done['handle'] );

					if ( $active > 0 ) curl_multi_select( $multi, 0.1 );
				}
			}
		}
		while( $active > 0 );

		curl_multi_close( $multi );
		return $result;
	}
?>
