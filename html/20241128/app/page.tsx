import Image from "next/image";

const Home = () => {
  return (
    <div className="min-h-screen bg-primary text-white">
      {/* ヒーローセクション */}
      <header className="relative h-screen flex items-center justify-center text-center bg-black">
        <video
          className="absolute inset-0 w-full h-full object-cover opacity-70"
          autoPlay
          muted
          loop
        >
          <source src="/mv.mp4" type="video/mp4" />
        </video>
        <div className="relative z-10">
          <h1 className="text-5xl font-extrabold drop-shadow-lg fade-in">
            未来をつかむ、私たちの第一歩
          </h1>
          <p className="text-xl mt-4 fade-in">
            オープンキャンパスで新たな可能性を見つけよう
          </p>
        </div>
      </header>

      {/* 写真ギャラリーセクション */}
      <section className="py-16 fade-in">
        <h2 className="text-center text-4xl font-bold mb-8">
          オープンキャンパスの様子
        </h2>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 px-4">
          <Image
            src="/network.jpg"
            alt="キャンパス写真1"
            width={400}
            height={300}
            className="rounded-lg object-cover"
          />
          <Image
            src="/鬼の龍吾.png"
            alt="キャンパス写真1"
            width={400}
            height={300}
            className="rounded-lg object-cover"
          />
          <Image
            src="/k2.jpg"
            alt="キャンパス写真1"
            width={400}
            height={300}
            className="rounded-lg object-cover"
          />
        </div>
      </section>

      {/* Q&Aセクション */}
      <section className="py-16 bg-gray-50 text-primary fade-in">
        <h2 className="text-center text-4xl font-bold mb-8">よくある質問</h2>
        <div className="max-w-2xl mx-auto space-y-6">
          <div className="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <h3 className="font-bold text-lg mb-2">
              Q: 参加費はかかりますか？
            </h3>
            <p className="text-gray-700">
              A: いいえ、オープンキャンパスは無料でご参加いただけます。
            </p>
          </div>
          <div className="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <h3 className="font-bold text-lg mb-2">Q: 持ち物はありますか？</h3>
            <p className="text-gray-700">
              A: 筆記用具とメモ帳をご持参ください。
            </p>
          </div>
          <div className="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <h3 className="font-bold text-lg mb-2">
              Q: 保護者も一緒に参加できますか？
            </h3>
            <p className="text-gray-700">
              A: はい、保護者の方も歓迎しております。
            </p>
          </div>
        </div>
      </section>

      {/* 匿名掲示板セクション */}
      <section className="py-16 bg-white text-primary fade-in">
        <h2 className="text-center text-4xl font-bold mb-8">
          みんなの声を聞かせて！
        </h2>
        <div className="max-w-2xl mx-auto">
          <div className="flex items-center mb-4">
            <input
              type="text"
              placeholder="投稿内容を入力してください..."
              className="w-full p-4 border-2 border-primary rounded-l-lg focus:outline-none"
            />
            <button className="bg-primary text-white px-4 py-2 rounded-r-lg hover:bg-blue-700">
              投稿
            </button>
          </div>
          <div className="space-y-4">
            <p className="text-center">まだ投稿がありません。</p>
          </div>
        </div>
      </section>

      {/* フッター */}
      <footer className="bg-gray-800 text-center text-white py-6">
        <p>
          &copy; 2024 オープンキャンパス情報サイト | お問い合わせ:
          info@campus.jp
        </p>
      </footer>
    </div>
  );
};

export default Home;
