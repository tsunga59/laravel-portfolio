## Acmo

**「ActiveなMorning(朝活)を通して、1日をもっと有意義に過ごそう」**というコンセプトをもとに開発した**朝活SNSサービス**

URL: https://acmo-app.com

## サービス概要

#### 基本的な機能・使い方

投稿・タグづけ・コメント・プロフィール・フォロー・いいね等の基本的なSNS機能の他、

朝活目標時間の設定・朝活達成日数(率)の表示・朝活達成ランキング・朝活ランクシステム(今後実装予定)等、朝活に特化した機能を実装しています。

特に下記のような特徴を持ったサービスです。

* 朝活仲間と投稿を共有したり、いいねやコメント等のリアクションを通して交流ができる
* 設定した朝活目標時間より前に投稿すると、朝活達成日数がカウントされる
* 朝活達成日数が多いユーザーはランキング表示される
* 朝活達成率に応じて各ユーザーにランクバッジが表示される(今後実装予定)


#### ターゲット(問題)

* 朝活をしたいけどモチベーションが続かない
* 朝活の継続方法を調べてはみるけど実践できない
* 1日のスタートが遅れてダラダラしてしまう

(全部自分ですが…)周りの友人で同じような悩みを抱えている人も結構多い印象です。。

#### メリット(解決策)

* 朝活内容の共有や仲間との交流によって、モチベーションの低下を防ぐ
* その日のタスクを朝にこなすことで、余裕を持って1日を過ごせる
* 朝の時間を使って新しいことにチャレンジできる

## 使用技術・ツール

#### フロントエンド

* HTML/CSS
* Sass
* JavaScript
* Vue.js

#### バックエンド

* PHP: 7.4.2
* Laravel: 8.45.1

#### インフラ

* Docker: 20.10.6
* Docker-compose: 1.29.1
* Nginx: 1.21.0
* MySQL: 5.7.34
* AWS(IAM, VPC, EC2, RDS, Route53, ACM, ELB, S3, CloudWatch,etc.)

#### その他ツール

* Git/Github(ソースコード・バージョン管理)
* Figma(ワイヤー作成)
* draw.io(ER図・インフラ構成図作成)
* Nortion(タスク管理・開発メモ)

#### ワイヤーフレーム

[Figma](https://www.figma.com/file/PlVDANTbGP1jRUfpvCG3Df/%E3%83%9D%E3%83%BC%E3%83%88%E3%83%95%E3%82%A9%E3%83%AA%E3%82%AA?node-id=0%3A1)
![wireframe](https://raw.githubusercontent.com/wiki/tsunga59/laravel-portfolio/wireframe.png)

#### URL設計

[Googleスプレッドシート](https://docs.google.com/spreadsheets/d/1-HKQVHc2H1sRljCJYMSkFLuDaZWvzj4S2SETDevr0pw/edit?usp=sharing)

![url_structure](https://raw.githubusercontent.com/wiki/tsunga59/laravel-portfolio/url_structure.png)

#### テーブル設計(ER図)

DB画像

#### インフラ設計(構成図)

AWS画像

## 実装機能

#### ユーザー登録・ログイン機能

#### ソーシャル(Google)ログイン機能

#### ゲストログイン機能

#### 投稿(CRUD)機能

基本的な〇〇

#### タグ付け機能

#### いいね機能

#### コメント機能

#### プロフィール編集機能

#### 画像アップロード機能

#### フォロー機能

#### 朝活達成判定(ポップアップ表示)機能

#### 朝活達成ランキング機能

#### レスポンシブ対応


## 工夫したこと


## 苦労したこと


## 今後の課題
